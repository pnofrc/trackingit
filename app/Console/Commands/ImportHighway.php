<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Models\Highway;

class ImportHighway extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:highway {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import highway geojson into db';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('File does not exist.');
            return;
        }

        $contents = file_get_contents($filePath);

        if ($contents === false) {
            $this->error('Failed to read file.');
            return;
        }

        $geojson = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid GeoJSON file: ' . json_last_error_msg());
            return;
        }

        if (!isset($geojson['features'])) {
            $this->error('Invalid GeoJSON structure: "features" key is missing.');
            return;
        }

        foreach ($geojson['features'] as $feature) {
            if (!isset($feature['properties']) || !isset($feature['geometry'])) {
                $this->error('Invalid GeoJSON feature structure.');
                continue;
            }

            $properties = $feature['properties'];
            $geometry = json_encode($feature['geometry']);

            // Ensure the geometry data is valid GeoJSON
            if (!$this->isValidGeoJson($geometry)) {
                $this->error('Invalid GeoJSON geometry data.');
                continue;
            }

            Highway::create([
                'name' => $properties['namn1'],
                'highway_code' => $properties['f_code'],
                'geojson' => $geometry,
                'geom' => DB::raw("ST_GeomFromGeoJSON('$geometry')")
            ]);
        }

        $this->info('Highway GeoJSON data imported successfully.');
    }

    private function isValidGeoJson($json)
    {
        $data = json_decode($json, true);
        return (json_last_error() === JSON_ERROR_NONE) && isset($data['type']) && isset($data['coordinates']);
    
    }
}

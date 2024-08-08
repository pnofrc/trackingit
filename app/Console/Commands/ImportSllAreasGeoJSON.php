<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\SllArea;

class ImportSllAreasGeoJSON extends Command
{
    protected $signature = 'import:sllareas {file}';
    protected $description = 'Import SLL areas GeoJSON data into database';

    public function handle()
    {
        ini_set('memory_limit', '1G'); // Increase to 1 GB the memory

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

            print($this->info( $properties['SLL_2011']));

            SllArea::create([
                'sll_2011' => $properties['SLL_2011'],
                'geojson' => $geometry,
                'geom' => DB::raw("ST_GeomFromGeoJSON('$geometry')")
            ]);
        }

        $this->info('SLL areas GeoJSON data imported successfully.');
    }

    private function isValidGeoJson($json)
    {
        $data = json_decode($json, true);
        return (json_last_error() === JSON_ERROR_NONE) && isset($data['type']) && isset($data['coordinates']);
    }
}

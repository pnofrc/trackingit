<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\GeoJsonData;

class ImportGeoJSONData extends Command
{
    protected $signature = 'import:geojson {file}';
    protected $description = 'Import GeoJSON data into database';

    public function handle()
    {
        $filePath = $this->argument('file');
        $contents = file_get_contents($filePath);
        $geojson = json_decode($contents, true);

        foreach ($geojson['features'] as $feature) {
            // Assuming 'name' and 'geometry' properties in GeoJSON
            $name = $feature['properties']['name'];
            $geometry = json_encode($feature['geometry']);

            // Store GeoJSON data in database
            GeoJsonData::create([
                'name' => $name,
                'geojson' => $geometry,
                'geom' => DB::raw("ST_GeomFromGeoJSON('$geometry')")
            ]);
        }

        $this->info('GeoJSON data imported successfully.');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Municipality;

class ImportMunicipalitiesGeoJSON extends Command
{
    protected $signature = 'import:municipalities {file}';
    protected $description = 'Import municipalities GeoJSON data into database';

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

            Municipality::create([
                'region_code' => $properties['COD_REG'],
                'province_code' => $properties['COD_PROV'],
                'municipality_code' => $properties['PRO_COM'],
                'geojson' => $geometry,
                'geom' => DB::raw("ST_GeomFromGeoJSON('$geometry')")
            ]);
        }

        $this->info('Municipalities GeoJSON data imported successfully.');
    }

    private function isValidGeoJson($json)
    {
        $data = json_decode($json, true);
        return (json_last_error() === JSON_ERROR_NONE) && isset($data['type']) && isset($data['coordinates']);
    }
}

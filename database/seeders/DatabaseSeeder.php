<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GeoJsonData;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@tracking.it',
            'password' => 'password'
        ]);


        $filePath = '/var/www/vhosts/gifted-borg.217-160-114-177.plesk.page/httpdocs/public/datasets/comuni.geojson';
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


        
    }
}

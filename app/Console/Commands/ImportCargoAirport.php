<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Models\CargoAirport; 

class ImportCargoAirport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cargoairport {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CargoAirport GeoJSON features (Points) into db using PostGIS.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0); 
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('File non trovato: ' . $filePath);
            return 1;
        }

        $contents = file_get_contents($filePath);
        $geojson = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($geojson['features'])) {
            $this->error('File GeoJSON non valido o struttura mancante.');
            return 1;
        }

        // SRID corretto per CRS84 (Long/Lat)
        $srid = 4326; 
        $count = 0;
        $featuresCount = count($geojson['features']);
        
        $this->info("Inizio importazione di **$featuresCount** Cargo Airport features (SRID $srid)...");
        $bar = $this->output->createProgressBar($featuresCount);
        $bar->start();

        foreach ($geojson['features'] as $feature) {
            
            if (!$this->isValidGeoJsonFeature($feature)) {
                $bar->advance();
                continue;
            }

            $properties = $feature['properties'];
            $fullFeatureJson = json_encode($feature); 
            $geometryJson = json_encode($feature['geometry']);
            
            DB::beginTransaction();

            try {
                
                CargoAirport::create([
                    // Mappatura delle proprietà
                    'airport_name' => $properties['Aeroporto'] ?? null,
                    'municipality' => $properties['Comune'] ?? null,
                    'iata_code'    => $properties['Codice IATA'] ?? null,
                    'icao_code'    => $properties['Codice ICAO'] ?? null,
                    'operator'     => $properties['Gestore'] ?? null,
                    
                    // GeoJSON completo
                    'geojson'      => $fullFeatureJson, 
                    
                    // Conversione PostGIS con cast esplicito ::text
                    'geom'         => DB::raw("ST_GeomFromGeoJSON('$geometryJson')")
                ]);

                DB::commit();
                $count++;

            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("\nErrore durante l'importazione dell'aeroporto {$properties['Aeroporto']}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("\n\nImportazione Cargo Airport completata. Totale feature importate: **$count**.");
        return 0; 
    }

    /**
     * Controlla la struttura base di una singola Feature GeoJSON.
     */
    private function isValidGeoJsonFeature($feature)
    {
        return isset($feature['properties']) 
               && isset($feature['geometry'])
               && isset($feature['geometry']['type'])
               && isset($feature['geometry']['coordinates']);
    }
}
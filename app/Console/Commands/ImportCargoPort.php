<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Models\CargoPort; 

class ImportCargoPort extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cargoport {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CargoPort GeoJSON features (Points) into db using PostGIS.';

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

        // SRID per CRS84 (Long/Lat)
        $srid = 4326; 
        $count = 0;
        $featuresCount = count($geojson['features']);
        
        $this->info("Inizio importazione di **$featuresCount** Cargo Port features (SRID $srid)...");
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
                
                CargoPort::create([
                    // Mappatura delle proprietà del dataset Cargo Port
                    'idporto'      => $properties['idporto'] ?? null,
                    'locode'       => $properties['locode'] ?? null,
                    'name'         => $properties['nome'] ?? null, // Mappa "nome" a "name"
                    'importance'   => $properties['importante'] ?? null, // Mappa "importante" a "importance"
                    
                    // GeoJSON completo
                    'geojson'      => $fullFeatureJson, 
                    
                    // Conversione PostGIS con cast esplicito ::text
                    'geom'         => DB::raw("ST_GeomFromGeoJSON('$geometryJson')")
                ]);

                DB::commit();
                $count++;

            } catch (\Exception $e) {
                DB::rollBack();
                $portName = $properties['nome'] ?? 'Sconosciuto';
                $this->error("\nErrore durante l'importazione del porto $portName: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("\n\nImportazione Cargo Port completata. Totale feature importate: **$count**.");
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
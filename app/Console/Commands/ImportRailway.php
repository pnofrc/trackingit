<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Models\Railway; // Assicurati che questo puntamento sia corretto

class ImportRailway extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:railway {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import railway GeoJSON features into db using PostGIS.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0); 

        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('File does not exist.');
            return 1;
        }

        $contents = file_get_contents($filePath);
        $geojson = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($geojson['features'])) {
            $this->error('Invalid GeoJSON file or structure.');
            return 1;
        }
        
        // SRID corretto da utilizzare (EPSG::3857, come visto nel tuo GeoJSON)
        $srid = 3857; 
        $count = 0;
        $featuresCount = count($geojson['features']);
        
        $this->info("Importing **$featuresCount** railway features...");
        $bar = $this->output->createProgressBar($featuresCount);
        $bar->start();

        foreach ($geojson['features'] as $feature) {
            
            if (!$this->isValidGeoJsonFeature($feature)) {
                $this->warn('Skipping feature with invalid structure or geometry.');
                $bar->advance();
                continue;
            }

            $properties = $feature['properties'];
            
            // L'intera feature serializzata per il campo 'geojson'
            $fullFeatureJson = json_encode($feature); 
            
            // Solo la geometria serializzata per il campo 'geom'
            $geometryJson = json_encode($feature['geometry']);
            
            DB::beginTransaction();

            try {
                
                Railway::create([
                    // Campi delle proprietà (usa l'operatore null-coalescing ?? per i campi mancanti)
                    'name'         => $properties['name'] ?? null,
                    'railway_type' => $properties['railway'] ?? null, // Mappa a "railway" in properties
                    'usage'        => $properties['usage'] ?? null,
                    'ref'          => $properties['ref'] ?? null,
                    'maxspeed'     => $properties['maxspeed'] ?? null,
                    'operator'     => $properties['operator'] ?? null,
                    
                    // Salva l'intera feature GeoJSON
                    'geojson'      => $fullFeatureJson, 
                    
                    // Conversione PostGIS con cast esplicito ::text (per evitare l'errore 42883)
                    'geom'         => DB::raw("ST_GeomFromGeoJSON('$geometryJson')")
                ]);

                DB::commit();
                $count++;

            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("\nFailed to import feature (ID: {$properties['osm_id']}): " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->info("\n\nImportazione Railway completata. Totale feature importate: **$count**.");
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
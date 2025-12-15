<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\MunicipalityData;

use App\Models\SllArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SllAreaData;

use App\Models\Interport;
use App\Models\Highway;
use App\Models\Railway;
use App\Models\AlpinePass;
use App\Models\CargoPort;
use App\Models\CargoAirport;

class GeoJsonController extends Controller
{
    // // Fetch all GeoJSON Muncipality data
    public function indexMunicipalities()
    {
        $places = Municipality::select('municipality_code', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.1))::json AS geom"))
            ->get();

            // dd($places);

        return response()->json($places);
    }


    // Fetch all GeoJSON SLL data
    public function indexSLL()
    {
        $places = SllArea::select('sll_2011', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))
            ->get();


        return response()->json($places);
    }


    // Fetch data of a SLL
    public function getSllAreaData($id)
    {
        $sllAreaData = SllAreaData::where('COD_SLL_2011_2018', $id)->get();
        return response()->json($sllAreaData);
    }

    // Fetch data of a municipality

    public function getComuniData($id)
    {
        $comuniData = MunicipalityData::where('PRO_COM', $id)->get();
        return response()->json($comuniData);
    }


    // Fetch SLL with indicators
    public function indexSllWithIndicators($indicators)
    {

        // $indicators non contiene più '+' e 'NONE' se hai corretto il frontend.
        // Se il frontend invia ancora POP21+NONE, $parsedIndicators[1] sarà 'NONE'.
        $parsedIndicators = explode('+', $indicators);
        $indicator1 = $parsedIndicators[0]; // Prende il primo (e unico) indicatore.

        // 1. Prendi i dati SLL (geometria)
        $places = SllArea::select('sll_2011', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))
            ->get()->toArray();

        // 2. Prendi i dati degli indicatori (inclusi ID e Nome per il merge)
        $indicatorData = SllAreaData::select('COD_SLL_2011_2018', 'DEN_SLL_2011_2018', $indicator1)
            ->get()->toArray();

        // Trasforma i dati degli indicatori in una mappa (key: sll_2011) per un merge efficiente
        $indicatorMap = [];
        foreach ($indicatorData as $data) {
            $indicatorMap[$data['COD_SLL_2011_2018']] = $data;
        }

        // 3. Esegui il merge (Geometria + Dati)
        $mixmix = [];
        foreach ($places as $place) {
            $sllCode = $place['sll_2011'];
            if (isset($indicatorMap[$sllCode])) {
                // Unisci i dati dell'indicatore con la geometria
                $mixmix[] = array_merge($place, $indicatorMap[$sllCode]);
            }
        }


        // 4. RESTITUISCI SEMPRE JSON
        return response()->json($mixmix);
    }


public function indexComuniWithIndicators($indicators)
    {
        // $indicators ora contiene solo l'indicatore 1, ma lo gestiamo in modo sicuro
        $parsedIndicators = explode('+', $indicators);
        $indicator1 = $parsedIndicators[0];

        // 1. Geometria dei Comuni
        $places = Municipality::select('municipality_code', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.005))::json AS geom"))
            ->get()->toArray();

        // 2. Dati degli Indicatori + Nome/Codice per il merge
        // Seleziona i campi necessari per il merge
        $indicatorData = MunicipalityData::select('PRO_COM', 'COMUNE', $indicator1)->get()->toArray();

        // Trasforma i dati in una mappa (key: PRO_COM)
        $indicatorMap = [];
        foreach ($indicatorData as $data) {
            $indicatorMap[$data['PRO_COM']] = $data;
        }

        // 3. Combina Geometria + Dati
        $mixmix = [];
        foreach ($places as $place) {
            $proCom = $place['municipality_code'];
            if (isset($indicatorMap[$proCom])) {
                // Unisci la geometria con i dati degli indicatori
                $mixmix[] = array_merge($place, $indicatorMap[$proCom]);
            }
        }

        // 4. RESTITUISCI SEMPRE JSON
        return response()->json($mixmix);
    }


    public function getInterports()
    {
        $interports = Interport::select('name', 'city', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))->get();

        return response()->json($interports); // Devi restituire la risposta JSON
    }

    /**
     * Recupera i dati di Alpine Passes, convertendo la geometria in GeoJSON.
     */
    public function getAlpinePasses()
    {
        // Seleziona nome, latitudine, longitudine, rotazione e converte la geometria (geom) in GeoJSON
        // ST_Simplify è utile per ridurre la complessità se le geometrie fossero più grandi (LineStrings o Polygons),
        // ma è mantenuto per coerenza con l'esempio originale (anche se su Point non ha effetto).
        $alpinePasses = AlpinePass::select('name', 'latitude', 'longitude', 'rotation', 
            DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom")
        )->get();

        return response()->json($alpinePasses);
    }

    /**
     * Recupera i dati di Cargo Ports, convertendo la geometria in GeoJSON.
     */
    public function getCargoPorts()
    {
        // Seleziona idporto, locode, name, importance e converte la geometria in GeoJSON
        $cargoPorts = CargoPort::select('idporto', 'locode', 'name', 'importance', 
            DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom")
        )->get();

        return response()->json($cargoPorts);
    }

    /**
     * Recupera i dati di Cargo Airports, convertendo la geometria in GeoJSON.
     */
    public function getCargoAirports()
    {
        // Seleziona i campi specifici e converte la geometria in GeoJSON
        $cargoAirports = CargoAirport::select('airport_name', 'municipality', 'iata_code', 'icao_code', 'operator', 
            DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom")
        )->get();

        return response()->json($cargoAirports);
    }


    public function getHighways()
    {
        $highways = Highway::select('name', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.001))::json AS geom"))->get();
        return response()->json($highways); 
    }

    
    


    public function getRailway(Request $request)
{
    // Imposta il livello di zoom e il BBOX richiesti
    $zoom = $request->get('zoom', 6);
    $bounds = $request->get('bounds'); 
    
    // 1. Determina la tolleranza di semplificazione basata sullo zoom
    // Questo riduce il dettaglio per carichi veloci a livelli di zoom bassi.
    $tolerance = match (true) {
        $zoom <= 6 => 500000,
        $zoom <= 8 => 300000,
        $zoom <= 10 => 250000,
        $zoom <= 12 => 200000,
        default => 100000,
    };
    
    $query = Railway::select('name', 
        // Genera il GeoJSON come STRINGA SQL pura (AS geom_string). 
        // Rimuovendo ::json si impedisce a Laravel di codificare due volte.
        DB::raw("ST_AsGeoJSON(ST_Simplify(geom, {$tolerance})) AS geom_string")
    );
    
    // **FILTRO ESSENZIALE 1:** Esclude i record che non hanno una geometria definita a livello di database.
    $query->whereNotNull('geom'); 
    
    // 2. Filtro per Bounding Box (BBOX)
    if ($bounds) {
        try {
            // Estrae le coordinate: latMin, lngMin, latMax, lngMax
            [$latMin, $lngMin, $latMax, $lngMax] = explode(',', $bounds);
            
            // Crea l'oggetto BBOX PostGIS
            $bbox = "ST_MakeEnvelope({$lngMin}, {$latMin}, {$lngMax}, {$latMax}, 4326)";
            
            // Filtra le geometrie che intersecano il riquadro visibile
            $query->whereRaw("ST_Intersects(geom, {$bbox})");
            
        } catch (\Exception $e) {
             // Gestione di un BBOX malformato
            \Log::error('Errore nel parsing del BBOX per le ferrovie: ' . $e->getMessage());
        }
    }
    
    // Limita il numero di risultati per prevenire crash (fino a 50.000)
    $railway = $query->limit(50000)->get(); 
    
    // 3. Struttura la risposta come FeatureCollection
    $features = $railway
        ->map(function($r) {
            // Decodifica la stringa GeoJSON in un oggetto PHP
            $geometry = json_decode($r->geom_string);
            
            // **FILTRO ESSENZIALE 2:** Verifica che la geometria decodificata sia un oggetto valido
            // e non sia una GeometryCollection (spesso problematica in Leaflet).
            if (!is_object($geometry) || !isset($geometry->type) || $geometry->type === 'GeometryCollection') {
                return null; // Salta questa feature non valida
            }

            return [
                'type' => 'Feature',
                'properties' => ['name' => $r->name],
                // Passa l'oggetto geometria decodificato (JSON pulito)
                'geometry' => $geometry, 
            ];
        })
        // Rimuove tutti gli elementi nulli generati dal filtro essenziale 2
        ->filter()
        ->values() // Ri-indicizza l'array per un JSON pulito
        ->all();

    // Invia la risposta finale in formato GeoJSON FeatureCollection
    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features
    ]);
}




    // get min and max of an idicator (for the color visualization)
    // get min and max of an idicator (for the color visualization)
    public function getIndicatorRange($type, $indicator)
    {
        if ($indicator == "NONE") {
            return response()->json([
                'min' => 0,
                'max' => 0
            ]);
        }

        // Seleziona il modello corretto in base al tipo (sll o comuni)
        if (strtolower($type) == 'sll') {
            $model = SllAreaData::class;
        } elseif (strtolower($type) == 'comuni') {
            $model = MunicipalityData::class;
        } else {
            // Gestione di un tipo non valido (es. errore 404)
            return response()->json(['error' => 'Invalid data type specified.'], 400);
        }

        // Usa il modello dinamico
        $minValue = $model::min($indicator);
        $maxValue = $model::max($indicator);

        return response()->json([
            'min' => $minValue,
            'max' => $maxValue
        ]);
    }




}
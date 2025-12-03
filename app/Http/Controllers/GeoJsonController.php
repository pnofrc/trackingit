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
        $highways = Highway::select('name', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))->get();
        return response()->json($highways); 
    }

        public function getRailway()
    {
        $railway = Railway::select('name', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.05))::json AS geom"))->get();
    
    // $limit = $request->get('limit', 10000);
    //     $railways = Railway::select('name', 
    //         DB::raw("ST_AsGeoJSON(ST_Simplify(geom, {$tolerance}))::json AS geom")
    //     )
    //     ->paginate($limit);

        // dd(Railway::select('name')->get());

        return response()->json($railways);
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
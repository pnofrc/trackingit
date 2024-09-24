<?php

namespace App\Http\Controllers;

use App\Models\Municipality;

use App\Models\SllArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SllAreaData;
use App\Models\Interport;
use App\Models\Highway;

class GeoJsonController extends Controller
{
    // Fetch all GeoJSON Muncipality data
    public function indexMunicipalities()
    {
        $places = Municipality::select('municipality_code', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))
            ->get();


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

    public function getComuniAreaData($id)
    {
        // TODO: edit qua COMUNI
        $comuniAreaData = SllAreaData::where('COD_COM_2011_2018', $id)->get();
        return response()->json($comuniAreaData);
    }


    // Fetch SLL with indicators
    public function indexSllWithIndicators($indicators)
    {

        $parsedIndicators = explode('+', $indicators);

        // SLL data
        $places = SllArea::select('sll_2011', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))
            ->get()->toArray();

        $nameSll = SllAreaData::select('DEN_SLL_2011_2018')->get()->toArray();


        // indicators data

        $indicator1Data = SllAreaData::select($parsedIndicators[0])->get()->toArray();
        if ($parsedIndicators[1] != 'NONE') {
            $indicator2Data = SllAreaData::select($parsedIndicators[1])->get()->toArray();

            // merge all the values in an array
            $mixmix = array_map(function ($a1, $a2, $a3, $a4) {
                return array_merge($a1, $a2, $a3, $a4);
            }, $nameSll, $indicator1Data, $indicator2Data, $places);

        } else {
            // merge all the values in an array
            $mixmix = array_map(function ($a1, $a2, $a3) {
                return array_merge($a1, $a2, $a3);
            }, $nameSll, $indicator1Data, $places);
        }


        return $mixmix;
    }

    public function indexComuniWithIndicators($indicators)
    {

        $parsedIndicators = explode('+', $indicators);

        // Comuni data //TODO: COMUNI
        $places = SllArea::select('comuni_2011', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))
            ->get()->toArray();

        $nameComuni = SllAreaData::select('DEN_SLL_2011_2018')->get()->toArray();


        // indicators data

        $indicator1Data = SllAreaData::select($parsedIndicators[0])->get()->toArray();
        if ($parsedIndicators[1] != 'NONE') {
            $indicator2Data = SllAreaData::select($parsedIndicators[1])->get()->toArray();

            // merge all the values in an array
            $mixmix = array_map(function ($a1, $a2, $a3, $a4) {
                return array_merge($a1, $a2, $a3, $a4);
            }, $nameComuni, $indicator1Data, $indicator2Data, $places);

        } else {
            // merge all the values in an array
            $mixmix = array_map(function ($a1, $a2, $a3) {
                return array_merge($a1, $a2, $a3);
                // TODO: COMUNI
            }, $nameComuni, $indicator1Data, $places);
        }


        return $mixmix;
    }

    public function getInterports()
    {
        $interports = Interport::select('name', 'city', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))->get();
        
        return response()->json($interports); // Devi restituire la risposta JSON
    }

    public function getHighways()
    {
        $highways = Highway::select('name', DB::raw("ST_AsGeoJSON(ST_Simplify(geom, 0.01))::json AS geom"))->get();
        return response()->json($highways); // Devi restituire la risposta JSON
    }


    // get min and max of an idicator (for the color visualization)
    public function getIndicatorRange($indicator)
    {

        if ($indicator == "NONE") {
            return response()->json([
                'min' => 0,
                'max' => 0
            ]);
        } else {
            $minValue = SllAreaData::min($indicator);
            $maxValue = SllAreaData::max($indicator);

            return response()->json([
                'min' => $minValue,
                'max' => $maxValue
            ]);
        }


    }




}
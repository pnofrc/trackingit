<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\SllArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SllAreaData;

class GeoJsonController extends Controller
{
    // Fetch all GeoJSON Muncipality data
    public function indexMunicipalities()
    {
        $places = Municipality::select('municipality_code', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
            ->get();


        return response()->json($places);
    }


    // Fetch all GeoJSON SLL data
    public function indexSLL()
    {
        $places = SllArea::select('sll_2011', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
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


    // Fetch SLL with indicators
    public function indexSllWithIndicators($indicators)
    {

        $parsedIndicators = explode('+', $indicators);

        // SLL data
        $places = SllArea::select('sll_2011', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
        ->get()->toArray();

        $nameSll = SllAreaData::select('DEN_SLL_2011_2018')->get()->toArray();

        // indicators data
        $indicator1Data = SllAreaData::select($parsedIndicators[0])->get()->toArray();

        if($parsedIndicators[1] != 'NONE'){
            $indicator2Data = SllAreaData::select($parsedIndicators[1])->get()->toArray();
            
             // merge all the values in an array
        $mixmix = array_map(function($a1, $a2, $a3, $a4) {
            return array_merge($a1, $a2, $a3, $a4);
        }, $nameSll, $indicator1Data, $indicator2Data, $places);

        } else {
        // merge all the values in an array
        $mixmix = array_map(function($a1, $a2, $a3 ) {
            return array_merge($a1, $a2, $a3);
        }, $nameSll, $indicator1Data,  $places);
        }
        

        return $mixmix;
    }


    // get min and max of an idicator (for the color visualization)
    public function getIndicatorRange($indicator)
    {
      
        if($indicator == "NONE"){
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
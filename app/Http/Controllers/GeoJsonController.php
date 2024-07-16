<?php

namespace App\Http\Controllers;
use App\Models\GeoJsonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoJsonController extends Controller
{
    // Fetch all GeoJSON data
    public function index()
    {
        $places = GeoJsonData::select('name', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
                ->get();
                
                dd($places);

    return response()->json($places);
}

}
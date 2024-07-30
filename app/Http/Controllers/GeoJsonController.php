<?php

namespace App\Http\Controllers;
use App\Models\Municipality;
use App\Models\SllArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoJsonController extends Controller
{
    // Fetch all GeoJSON Muncipality data
    public function indexMunicipalities()
    {
        $places = Municipality::select('municipality_code', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
                ->get();
                

    return response()->json($places);
}

public function indexSLL()
{
    $places = SllArea::select('sll_2011', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
            ->get();
            

return response()->json($places);
}

}
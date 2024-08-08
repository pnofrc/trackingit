<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\News;
use App\Models\Latests;

use App\Models\SllAreaCsv;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContentsController extends Controller
{


    public function getLatests(){

        $latests =  Latests::get()->toArray();

		return view('home', ['latests' => $latests]);
    }

    public function getBlog(){

        $blogs =  Blog::get()->toArray();


		return view('blog', ['blogs' => $blogs]);
    }

    public function getNews(){

        $news =  News::get();

		return view('news', ['news' => $news]);
    }

    public function viewDashboard(){
        return view('dashboard', ['sllAreaData' => []]);
    }





    // public function getSllGeoJson() {
    //     $data = SllAreaData::select('COD_SLL_2011_2018', 'geom')->get();

    //     return response()->json($data);
    // }



    // public function getComuniGeoJson() {
    //     $data = DB::table('comuni_area_data')
    //               ->select('COD_COM', 'geom', 'POP11', 'PST11', 'PD11', 'RedMed11', 'POP21', 'PST21', 'PD21', 'RedMed21')
    //               ->get();
    //     return response()->json($data);
    // }
}

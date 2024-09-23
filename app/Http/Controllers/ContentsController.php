<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\News;
use App\Models\Latests;
use App\Models\Highway;

use App\Models\Indicator;
use App\Models\Interport;
use App\Models\SllAreaCsv;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContentsController extends Controller
{


    public function getLatests()
    {

        $latests = Latests::get()->toArray();

        return view('home', ['latests' => $latests]);
    }

    public function getBlog()
    {

        $blogs = Blog::get()->toArray();


        return view('blog', ['blogs' => $blogs]);
    }

    public function getNews()
    {

        $news = News::get();

        return view('news', ['news' => $news]);
    }


    public function getHighways()
    {
        $highways = Highway::select('name', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
            ->get();

        return response()->json($highways);
    }



    public function getInterports()
    {
        $interports = Interport::select('name', DB::raw("ST_AsGeoJSON(geom)::json AS geom"))
            ->get();



        return response()->json($interports);
    }

    public function viewDashboard()
    {
        $highways = $this->getHighways();
        $interports = $this->getInterports();

        return view('dashboard', ['sllAreaData' => []]);
        // return view('dashboard', ['highways' => $highways, 'interports' => $interports,'sllAreaData' => [], 'MunicipalitiesData' => []]);

    }

    public function getDataViz()
    {

        $visualizations = Indicator::select('id','name','description')->get();
        return view('visualization', ['visualizations' => $visualizations]);
    }

    public function getCharts($id)
    {   
        $chart = Indicator::where('id', $id)->get();
        return $chart;
    }


}

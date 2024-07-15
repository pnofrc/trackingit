<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\News;
use App\Models\Latests;

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
}

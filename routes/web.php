<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\ContentsController@getLatests');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/visualization', function () {
    return view('visualization');
});

Route::get('/blog', 'App\Http\Controllers\ContentsController@getBlog');

Route::get('/news', 'App\Http\Controllers\ContentsController@getNews');


Route::get('/about', function () {
    return view('about');
});

use App\Http\Controllers\GeoJsonController;

Route::get('/geojson', [GeoJsonController::class, 'index']);

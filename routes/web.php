<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\ContentsController@getLatests');

Route::get('/dashboard', 'App\Http\Controllers\ContentsController@viewDashboard');


Route::get('/visualization', function () {
    return view('visualization');
});

Route::get('/blog', 'App\Http\Controllers\ContentsController@getBlog');

Route::get('/news', 'App\Http\Controllers\ContentsController@getNews');


Route::get('/about', function () {
    return view('about');
});

use App\Http\Controllers\GeoJsonController;

Route::get('/comuni', [GeoJsonController::class, 'indexMunicipalities']);
Route::get('/sll', [GeoJsonController::class, 'indexSLL']);

use App\Http\Controllers\ContentsController;

Route::get('/getSllAreaData/{id}', [ContentsController::class, 'getSllAreaData']);
Route::get('/getMunicipalityData/{id}', [ContentsController::class, 'getMunicipalityData']);

Route::get('/getIndicatorRange/{indicator}', [ContentsController::class, 'getIndicatorRange']);
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
Route::get('/Sll', [GeoJsonController::class, 'indexSLL']);

Route::get('/getSllAreaData/{id}', [GeoJsonController::class, 'getSllAreaData']);
Route::get('/getMunicipalityData/{id}', [GeoJsonController::class, 'getMunicipalityData']);

Route::get('/getIndicatorRange/{indicator}', [GeoJsonController::class, 'getIndicatorRange']);

Route::get('/getSllIndicatorsData/{indicators}', [GeoJsonController::class, 'indexSllWithIndicators']);

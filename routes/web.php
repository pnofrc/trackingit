<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoJsonController;
use App\Http\Controllers\ContentsController;

Route::get('/', [ContentsController::class, 'getLatests']);

Route::get('/dashboard', [ContentsController::class, 'viewDashboard']);

Route::get('/indicatori', [ContentsController::class, 'getDataViz']);

Route::get('/materiali', [ContentsController::class, 'getBlog']);

Route::get('/news', [ContentsController::class, 'getNews']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/comuni', [GeoJsonController::class, 'indexMunicipalities']);
Route::get('/Sll', [GeoJsonController::class, 'indexSLL']);

Route::get('/getSllAreaData/{id}', [GeoJsonController::class, 'getSllAreaData']);
Route::get('/getMunicipalityData/{id}', [GeoJsonController::class, 'getMunicipalityData']);

Route::get('/getIndicatorRange/{indicator}', [GeoJsonController::class, 'getIndicatorRange']);

Route::get('/getSllIndicatorsData/{indicators}', [GeoJsonController::class, 'indexSllWithIndicators']);
Route::get('/getComuniIndicatorsData/{indicators}', [GeoJsonController::class, 'indexComuniWithIndicators']);


Route::get('/getHighways', [GeoJsonController::class, 'getHighways']);

Route::get('/getInterports', [GeoJsonController::class, 'getInterports']);

Route::get('/getCharts/{id}', [ContentsController::class, 'getCharts']);
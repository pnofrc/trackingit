<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoJsonController;
use App\Http\Controllers\ContentsController;

Route::get('/', [ContentsController::class, 'getLatests']);

Route::get('/dashboard', [ContentsController::class, 'viewDashboard']);

Route::get('/data', [ContentsController::class, 'getDataViz']);

Route::get('/info-sheets', [ContentsController::class, 'getBlog']);

Route::get('/news', [ContentsController::class, 'getNews']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/comuni', [GeoJsonController::class, 'indexMunicipalities']);
Route::get('/Sll', [GeoJsonController::class, 'indexSLL']);

Route::get('/getSllAreaData/{id}', [GeoJsonController::class, 'getSllAreaData']);
Route::get('/getComuniData/{id}', [GeoJsonController::class, 'getComuniData']);

Route::get('/getIndicatorRange/{indicator}', [GeoJsonController::class, 'getIndicatorRange']);

Route::get('/getSllIndicatorsData/{indicators}', [GeoJsonController::class, 'indexSllWithIndicators']);
Route::get('/getComuniIndicatorsData/{indicators}', [GeoJsonController::class, 'indexComuniWithIndicators']);


Route::get('/getHighways', [GeoJsonController::class, 'getHighways']);
Route::get('/getRailways', [GeoJsonController::class, 'getRailway']);

Route::get('/getInterports', [GeoJsonController::class, 'getInterports']);
Route::get('/getCargoPorts', [GeoJsonController::class, 'getCargoPorts']);
Route::get('/getCargoAirports', [GeoJsonController::class, 'getCargoAirports']);
Route::get('/getAlpinePasses', [GeoJsonController::class, 'getAlpinePasses']);

Route::get('/getCharts/{id}', [ContentsController::class, 'getCharts']);

    
// 3. Route per i range (come discusso nell'ultima risposta)
Route::get('/getIndicatorRange/{type}/{indicator}', [GeoJsonController::class, 'getIndicatorRange']);
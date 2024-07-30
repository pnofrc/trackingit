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

Route::get('/comuni', [GeoJsonController::class, 'indexMunicipalities']);
Route::get('/sll', [GeoJsonController::class, 'indexSLL']);



use App\Http\Controllers\CsvUploadController;

Route::post('/upload-sll-area-csv', [CsvUploadController::class, 'uploadSllAreaCsv'])->name('upload-sll-area-csv');
Route::post('/upload-municipality-csv', [CsvUploadController::class, 'uploadMunicipalityCsv'])->name('upload-municipality-csv');

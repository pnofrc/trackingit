<?php

namespace App\Filament\Resources\SllareaCSVResource\Pages;

use App\Filament\Resources\SllareaCSVResource;
use Filament\Resources\Pages\Page;

class UploadCsv extends Page
{
    protected static string $resource = SllareaCSVResource::class;

    protected static string $view = 'filament.resources.sllarea-csv-resource.pages.upload-csv';
}

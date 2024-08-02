<?php

namespace App\Filament\Resources\SllareaCsvResource\Pages;

use App\Filament\Resources\SllareaCsvResource;
use Filament\Resources\Pages\Page;

class UploadCsv extends Page
{
    protected static string $resource = SllareaCsvResource::class;

    protected static string $view = 'filament.resources.sllarea-csv-resource.pages.upload-csv';
}

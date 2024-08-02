<?php

namespace App\Filament\Resources\MunicipalityCsvResource\Pages;

use App\Filament\Resources\MunicipalityCsvResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMunicipalityCsvs extends ListRecords
{
    protected static string $resource = MunicipalityCsvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

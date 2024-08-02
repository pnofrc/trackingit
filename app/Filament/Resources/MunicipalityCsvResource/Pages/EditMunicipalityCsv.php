<?php

namespace App\Filament\Resources\MunicipalityCsvResource\Pages;

use App\Filament\Resources\MunicipalityCsvResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMunicipalityCsv extends EditRecord
{
    protected static string $resource = MunicipalityCsvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

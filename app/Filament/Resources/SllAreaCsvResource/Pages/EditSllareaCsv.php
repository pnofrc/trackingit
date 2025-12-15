<?php

namespace App\Filament\Resources\SllareaCSVResource\Pages;

use App\Filament\Resources\SllareaCSVResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSllareaCSV extends EditRecord
{
    protected static string $resource = SllareaCSVResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

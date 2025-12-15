<?php

namespace App\Filament\Resources\SllareaCSVResource\Pages;

use App\Filament\Resources\SllareaCSVResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSllareaCSVs extends ListRecords
{
    protected static string $resource = SllareaCSVResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

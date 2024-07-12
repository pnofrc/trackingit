<?php

namespace App\Filament\Resources\LatestsResource\Pages;

use App\Filament\Resources\LatestsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLatests extends ListRecords
{
    protected static string $resource = LatestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LatestsResource\Pages;

use App\Filament\Resources\LatestsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLatests extends EditRecord
{
    protected static string $resource = LatestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

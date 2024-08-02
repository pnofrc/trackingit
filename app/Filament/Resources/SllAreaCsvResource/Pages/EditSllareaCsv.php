<?php

namespace App\Filament\Resources\SllareaCsvResource\Pages;

use App\Filament\Resources\SllareaCsvResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSllareaCsv extends EditRecord
{
    protected static string $resource = SllareaCsvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

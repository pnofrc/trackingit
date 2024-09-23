<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipalityCsvResource\Pages;
use App\Filament\Resources\MunicipalityCsvResource\RelationManagers;
use App\Models\MunicipalityCsv;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MunicipalityCsvResource extends Resource
{
    protected static ?string $model = MunicipalityCsv::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-chevron-down';

    public static ?string $label = 'Dataset Comuni';
    public static ?string $navigationLabel = 'Dataset Comuni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMunicipalityCsvs::route('/'),
            'create' => Pages\CreateMunicipalityCsv::route('/create'),
            'edit' => Pages\EditMunicipalityCsv::route('/{record}/edit'),
        ];
    }
}

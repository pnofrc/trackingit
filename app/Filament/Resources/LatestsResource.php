<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LatestsResource\Pages;
use App\Filament\Resources\LatestsResource\RelationManagers;
use App\Models\Latests;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class LatestsResource extends Resource
{
    protected static ?string $model = Latests::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    public static ?string $label = 'Ultime Notizie';
    public static ?string $navigationLabel = 'Gestione Ultime Notizie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('latests')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListLatests::route('/'),
            'create' => Pages\CreateLatests::route('/create'),
            'edit' => Pages\EditLatests::route('/{record}/edit'),
        ];
    }
}

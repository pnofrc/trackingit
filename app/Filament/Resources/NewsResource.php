<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?int $navigationSort = 7;
    public static ?string $label = 'News';
    
    public static ?string $navigationLabel = 'Gestione News';
        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                Select::make('news_type')
                    ->options([
                        'Evento' => 'Evento',
                        'Pubblicazione' => 'Pubblicazione',
                        'Altro' => 'Altro',
                    ]),
                RichEditor::make('content')->required(),  
                DatePicker::make('date')->required(),
                TextInput::make('city')->required(),
                TextInput::make('external_link')->required(),
                FileUpload::make('picture')->preserveFilenames()->maxSize(1000)->directory('storage')
       
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('news_type'),
            ])
            ->filters([
                SelectFilter::make('news_type')
                    ->options([
                        'Evento' => 'Evento',
                        'Pubblicazione' => 'Pubblicazione',
                        'Altro' => 'Altro',
                    ])
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}

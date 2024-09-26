<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipalityCsvResource\Pages;
use App\Filament\Resources\MunicipalityCsvResource\RelationManagers;
use App\Models\MunicipalityCSV;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Models\MunicipalityData;

class MunicipalityCsvResource extends Resource
{
    protected static ?string $model = MunicipalityCSV::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-chevron-down';

    public static ?string $label = 'Dataset Comuni';
    public static ?string $navigationLabel = 'Dataset Comuni';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                FileUpload::make('file')
                    ->directory('storage')  // Directory to store the uploaded files
                    ->acceptedFileTypes(['text/csv'])  // Accept only CSV files
                    ->preserveFilenames()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('updated_at')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download DataSet')
                    ->action(function (MunicipalityCSV $record) {
                        return redirect()->to($record->file);
                    })
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('parse')
                    ->label('Parse CSV')
                    ->action(function (MunicipalityCSV $record) {
                        $resource = new \App\Filament\Resources\MunicipalityCsvResource();
                        $resource->parseCsv($record->file);
                    })
                    ->color('primary'),

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




    protected function parseCsv($file)
    {


        $filePath = Storage::disk('public')->path($file);
        if (!file_exists($filePath)) {
            dd('no');
        }

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        $expectedKeys = [
            'PRO_COM',
            'COMUNE',
            'POP21',
            'TPOP01_21',
            'TPOP11_21',
            'PST21',
            'VPST01_21',
            'VPST11_21',
            'PIS21',
            'VPIS01_21',
            'VPIS11_21',
            'RedMed21',
            'TRedMed01_21',
            'TRedMed11_21',
            'Dis21',
            'VDis11_21',
            'AddLog21',
            'TAddLog01_21',
            'TAddLog11_21',
            'XAdd_21',
            'VXAdd_11_21',
            'QLAdd_IT01',
            'QLAdd_IT11',
            'QLAdd_IT21',
            'VQLAdd_IT01_21',
            'VQLAdd_IT11_21',
            'StCAT21',
            'UIU13_21',
            'Imm21',
            'VImm13_21'
        ];


        $header = $csv->getHeader(); // Get the header row

        // Validate headers
        foreach ($expectedKeys as $key) {
            if (!in_array($key, $header)) {
                dd($key);
                dd('ATTENZIONE! FILE CSV NON COMPILATO CORRETTAMENTE');
            }
        }


        foreach ($csv->getRecords() as $record) {

            MunicipalityData::updateOrCreate(
                [
                    'PRO_COM' => $record['PRO_COM'],
                    'COMUNE' => $record['COMUNE'] ?? null,
                    'POP21' => $record['POP21'] ?? null,
                    'TPOP01_21' => $record['TPOP01_21'] ?? null,
                    'TPOP11_21' => $record['TPOP11_21'] ?? null,
                    'PST21' => $record['PST21'] ?? null,
                    'VPST01_21' => $record['VPST01_21'] ?? null,
                    'VPST11_21' => $record['VPST11_21'] ?? null,
                    'PIS21' => $record['PIS21'] ?? null,
                    'VPIS01_21' => $record['VPIS01_21'] ?? null,
                    'VPIS11_21' => $record['VPIS11_21'] ?? null,
                    'RedMed21' => $record['RedMed21'] ?? null,
                    'TRedMed01_21' => $record['TRedMed01_21'] ?? null,
                    'TRedMed11_21' => $record['TRedMed11_21'] ?? null,
                    'Dis21' => $record['Dis21'] ?? null,
                    'VDis11_21' => $record['VDis11_21'] ?? null,
                    'AddLog21' => $record['AddLog21'] ?? null,
                    'TAddLog01_21' => $record['TAddLog01_21'] ?? null,
                    'TAddLog11_21' => $record['TAddLog11_21'] ?? null,
                    'XAdd_21' => $record['XAdd_21'] ?? null,
                    'VXAdd_11_21' => $record['VXAdd_11_21'] ?? null,
                    'QLAdd_IT01' => $record['QLAdd_IT01'] ?? null,
                    'QLAdd_IT11' => $record['QLAdd_IT11'] ?? null,
                    'QLAdd_IT21' => $record['QLAdd_IT21'] ?? null,
                    'VQLAdd_IT01_21' => $record['VQLAdd_IT01_21'] ?? null,
                    'VQLAdd_IT11_21' => $record['VQLAdd_IT11_21'] ?? null,
                    'StCAT21' => $record['StCAT21'] ?? null,
                    'UIU13_21' => $record['UIU13_21'] ?? null,
                    'Imm21' => $record['Imm21'] ?? null,
                    'VImm13_21' => $record['VImm13_21'] ?? null,
                ]
            );
        }


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

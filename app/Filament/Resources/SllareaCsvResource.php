<?php

namespace App\Filament\Resources;
use League\Csv\Reader;
use Illuminate\Support\Facades\File;
use App\Filament\Resources\SllareaCsvResource\Pages;
use App\Filament\Resources\SllareaCsvResource\RelationManagers;
use App\Models\SllareaCsv;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Facades\Filament;
use App\Models\SllAreaData;
use App\Imports\ParsedSLLDataImport;

class SllareaCsvResource extends Resource
{
    protected static ?string $model = SllareaCSV::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-down';

    public static ?string $label = 'Dataset aree SLL';

    public static ?string $navigationLabel = 'Dataset aree SLL';


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
                    ->action(function (SllAreaCSV $record) {
                        return redirect()->to($record->file);
                    })
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('parse')
                    ->label('Parse CSV')
                    ->action(function (SllAreaCSV $record) {
                        $resource = new \App\Filament\Resources\SllareaCsvResource();
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
            'COD_SLL_2011_2018',
            'DEN_SLL_2011_2018',
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
            'VXAdd_01_21',
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
                dd('ATTENZIONE! FILE CSV NON COMPILATO CORRETTAMENTE');
            }
        }

        foreach ($csv->getRecords() as $record) {

            SllAreaData::updateOrCreate(
                [
                    'COD_SLL_2011_2018' => $record['COD_SLL_2011_2018'],
                    'DEN_SLL_2011_2018' => $record['DEN_SLL_2011_2018'] ?? null,
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
                    'VXAdd_01_21' => $record['VXAdd_01_21'] ?? null,
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
            'index' => Pages\ListSllareaCsvs::route('/'),
            'create' => Pages\CreateSllareaCsv::route('/create'),
            'edit' => Pages\EditSllareaCsv::route('/{record}/edit'),
        ];
    }
}

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
    protected static ?string $model = SllareaCsv::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                FileUpload::make('file')
                ->directory('uploads')  // Directory to store the uploaded files
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
                // Toggle::make('online')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download DataSet')
                    ->action(function (SllareaCsv $record) {
                        return redirect()->to($record->file);
                    })
                    ->openUrlInNewTab(),

                    Tables\Actions\Action::make('parse')
                        ->label('Parse CSV')
                        ->action(function (SllareaCsv $record) {
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

        $filePath= Storage::disk('public')->path($file);
        if (!file_exists($filePath)) {
            dd('no');
        }

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);
    
    $expectedKeys = [
            'COD_SLL_2011_2018', 'DEN_SLL_2011_2018', 'POP11', 'PST11', 'PD11', 'RedMed11', 'Dis11', 
            'AddTot11', 'AddLog11', 'QLAdd_IT11', 'ULTot11', 'ULLog11', 'AddULLog11', 'QLUL_IT11', 
            'PCSuolo12', 'POP21', 'TPOP11_21', 'TSM11_21', 'PST21', 'VPST11_21', 'PD21', 'VPD11_21', 
            'RedMed21', 'TRedMed11_21', 'Dis21', 'VDis11_21', 'AddTot21', 'TAddTot11_21', 'AddLog21', 
            'TAddLog11_21', 'QLAdd_IT21', 'VQLAdd_IT11_21', 'ULTot21', 'TULTot11_21', 'AddULTot21', 
            'VAddULTot11_21', 'ULLog21', 'TULLog11_21', 'AddULLog21', 'VAddULLog11_21', 'QLUL_IT21', 
            'VQLUL_IT11_21', 'PCSuolo21', 'VPCSuolo11_21'
        ];

        $header = $csv->getHeader(); // Get the header row
        
        // Validate headers
        foreach ($expectedKeys as $key) {
            if (!in_array($key, $header)) {
                dd('nope');
            }
        }

        // Parse records
        foreach ($csv->getRecords() as $record) {
            SllAreaData::updateOrCreate(
                ['COD_SLL_2011_2018' => $record['COD_SLL_2011_2018'],
                    'DEN_SLL_2011_2018' =>$record['DEN_SLL_2011_2018'] ?? null,
                    'POP11' => $record['POP11'] ?? null,
                    'PST11' => $record['PST11'] ?? null,
                    'PD11' => $record['PD11'] ?? null,
                    'RedMed11' => $record['RedMed11'] ?? null,
                    'Dis11' => $record['Dis11'] ?? null,
                    'AddTot11' => $record['AddTot11'] ?? null,
                    'AddLog11' => $record['AddLog11'] ?? null,
                    'QLAdd_IT11' => $record['QLAdd_IT11'] ?? null,
                    'ULTot11' => $record['ULTot11'] ?? null,
                    'ULLog11' => $record['ULLog11'] ?? null,
                    'AddULLog11' => $record['AddULLog11'] ?? null,
                    'QLUL_IT11' => $record['QLUL_IT11'] ?? null,
                    'PCSuolo12' => $record['PCSuolo12'] ?? null,
                    'POP21' => $record['POP21'] ?? null,
                    'TPOP11_21' => $record['TPOP11_21'] ?? null,
                    'TSM11_21' => $record['TSM11_21'] ?? null,
                    'PST21' => $record['PST21'] ?? null,
                    'VPST11_21' => $record['VPST11_21'] ?? null,
                    'PD21' => $record['PD21'] ?? null,
                    'VPD11_21' => $record['VPD11_21'] ?? null,
                    'RedMed21' => $record['RedMed21'] ?? null,
                    'TRedMed11_21' => $record['TRedMed11_21'] ?? null,
                    'Dis21' => $record['Dis21'] ?? null,
                    'VDis11_21' => $record['VDis11_21'] ?? null,
                    'AddTot21' => $record['AddTot21'] ?? null,
                    'TAddTot11_21' => $record['TAddTot11_21'] ?? null,
                    'AddLog21' => $record['AddLog21'] ?? null,
                    'TAddLog11_21' => $record['TAddLog11_21'] ?? null,
                    'QLAdd_IT21' => $record['QLAdd_IT21'] ?? null,
                    'VQLAdd_IT11_21' => $record['VQLAdd_IT11_21'] ?? null,
                    'ULTot21' => $record['ULTot21'] ?? null,
                    'TULTot11_21' => $record['TULTot11_21'] ?? null,
                    'AddULTot21' => $record['AddULTot21'] ?? null,
                    'VAddULTot11_21' => $record['VAddULTot11_21'] ?? null,
                    'ULLog21' => $record['ULLog21'] ?? null,
                    'TULLog11_21' => $record['TULLog11_21'] ?? null,
                    'AddULLog21' => $record['AddULLog21'] ?? null,
                    'VAddULLog11_21' => $record['VAddULLog11_21'] ?? null,
                    'QLUL_IT21' => $record['QLUL_IT21'] ?? null,
                    'VQLUL_IT11_21' => $record['VQLUL_IT11_21'] ?? null,
                    'PCSuolo21' => $record['PCSuolo21'] ?? null,
                    'VPCSuolo11_21' => $record['VPCSuolo11_21'] ?? null,
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

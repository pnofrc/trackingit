<?php

// app/Http/Controllers/CsvUploadController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SllAreaData;
use App\Models\MunicipalityData;
use Illuminate\Support\Facades\Storage;

class CsvUploadController extends Controller
{
    public function uploadSllAreaCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->store('csvs');

        $this->importCsvData(storage_path('app/' . $path), 'sll_area');

        return back()->with('success', 'CSV file has been uploaded and data imported.');
    }

    public function uploadMunicipalityCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->store('csvs');

        $this->importCsvData(storage_path('app/' . $path), 'municipality');

        return back()->with('success', 'CSV file has been uploaded and data imported.');
    }

    private function importCsvData($filePath, $type)
    {
        $data = array_map('str_getcsv', file($filePath, FILE_SKIP_EMPTY_LINES));
        $header = array_shift($data);

        if ($type === 'sll_area') {
            SllAreaData::truncate();
            foreach ($data as $row) {
                SllAreaData::create(array_combine($header, $row));
            }
        } elseif ($type === 'municipality') {
            MunicipalityData::truncate();
            foreach ($data as $row) {
                MunicipalityData::create(array_combine($header, $row));
            }
        }
    }
}

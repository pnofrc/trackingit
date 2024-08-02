<?php
// app/Http/Controllers/CSVImportController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SllareaCsvImport;

class CSVImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        Excel::import(new SllareaCsvImport, $file);

        return redirect()->back()->with('success', 'CSV Imported Successfully!');
    }
}

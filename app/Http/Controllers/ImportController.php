<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Imports\BulkDataImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    // Add this method to your controller

    public function import(Request $request)
    {
        // Validate that the file is present and in the correct format (XLSX or CSV)
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Get the uploaded file from the request
        $file = $request->file('file');

        // Use the BulkDataImport class to import the teacher data from the file
        Excel::import(new BulkDataImport, $file);

        // Return a success message
        return back()->with('success', 'Teachers imported successfully!');
    }
}

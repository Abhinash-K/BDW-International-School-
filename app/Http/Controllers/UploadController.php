<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeacherAssignmentImport;

class UploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        Excel::import(new TeacherAssignmentImport, $request->file('file'));

        return redirect()->back()->with('success', 'Teacher assignments imported successfully.');
    }
}

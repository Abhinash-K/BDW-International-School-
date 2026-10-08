<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Attachments extends Controller
{
    //run command to php artisan storage:link to generate storage folders
    public function index(Request $request){
        $files = Storage::disk('public')->allFiles('uploads');

        // Create a collection with file details
        $filesWithExtensions = collect($files)->map(function ($file) {
            return [
                'path' => $file, // Full path of the file
                'name' => basename($file), // File name
                'extension' => pathinfo($file, PATHINFO_EXTENSION), // File extension
            ];
        });
    
        // Paginate the collection
        $perPage = 40; // Number of items per page
        $currentPage = $request->input('page', 1); // Get current page from request
        $paginatedFiles = $filesWithExtensions->paginate($perPage, $currentPage, [
            'path' => $request->url(), // Ensures pagination URLs are correct
            'query' => $request->query(), // Retains existing query parameters
        ]);
        return view('attachments.index', compact('paginatedFiles'));
    }
}

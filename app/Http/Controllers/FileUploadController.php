<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * File Upload Class
 * Rich Text editor Helper Class
 */
class FileUploadController extends Controller
{

    /**
     * Upload Files
     * make sure storage folder in side Public folder has uploads/files folder 
     *
     * @param Request $request
     * @return void
     */
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/files', 'public');

            return response()->json(['link' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'File upload failed'], 400);
    }

    /**
     * Uoload Images method
     * make sure storage folder in side Public folder has uploads/images folder 
     *
     * @param Request $request
     * @return void
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->store('uploads/images', 'public');

            return response()->json(['link' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }

}

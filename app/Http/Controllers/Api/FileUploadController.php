<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        if ($request->file('file')->getClientOriginalExtension() !== 'apk') {
            return response()->json(['success' => false, 'message' => 'Only APK file allowed']);
        }


        // Handle file upload
        if ($file = $request->file('file')) {

            // Generate a unique name for the file with the .apk extension
            $filename = str_replace(" ", "-", config("app.name")) . "_" . time() . '.apk';
            $uploadedFile = $file->storeAs('uploads/app', $filename, 'public');

            // Check if the file was uploaded successfully
            if ($uploadedFile) {
                $data['path'] = $uploadedFile;

                return response()->json(['success' => true, 'message' => 'File uploaded successfully', "data" => $data]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to upload file']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Failed to upload file']);
    }
}

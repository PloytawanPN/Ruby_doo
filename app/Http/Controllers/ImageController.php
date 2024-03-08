<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage($filename)
    {
        // Assuming your images are stored in the 'storage/app/photos' directory
        $path = storage_path('app/photos/' . $filename);

        if (!Storage::disk('local')->exists('photos/' . $filename)) {
            abort(404);
        }

        // Serve the image with appropriate content type
        return response()->file($path);
    }
}

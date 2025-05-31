<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        if ($request->file('image')) {
            $path = ImageHelper::uploadImage($request->file('image'));
            ImageHelper::generateThumbnail($request->file('image', 300, 200));
            // $image = $request->file('image');
            // $path = $image->store('images', 'public');

            return response()->json([
                'success' => true,
                'path' => $path,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No image uploaded.',
        ], 400);
    }

    public function unlink_image(Request $request)
    {
        $path = $request->input('src');
;       $relativePath = explode('/storage/', parse_url($path, PHP_URL_PATH));
        
        if (ImageHelper::deleteImage($relativePath[1])) {
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to delete image.',
        ], 400);
    }
}

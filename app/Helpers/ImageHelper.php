<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;
use Intervention\Image\ImageManager;

class ImageHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    
    public static function uploadImage($file)
    {
        $path = $file->store('images', 'public');
        
        $fullPath = self::getImageUrl($path);
        return $fullPath;
    }

    public static function generateThumbnail($file, int $width = 300, int $height = 200)
    {
        $thumbnailImage = ImageManager::gd()->read($file)->resize($width, $height);
        // dd($file->getClientOriginalName());
        $path = 'images/thumbnails/'.$file->getClientOriginalName();
        Storage::disk('public')->put($path, $thumbnailImage->encodeByExtension($file->getClientOriginalExtension()));
        
        // return $path;
    }
    
    public static function deleteImage(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
    
    public static function getImageUrl(string $path): string
    {
        return asset(Storage::url($path));
    }
    
}

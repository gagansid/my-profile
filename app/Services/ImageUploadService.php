<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploadService
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Resize-down (no upscale), compress, and store an uploaded image on the public disk.
     * Deletes $oldPath (if given) after the new file is stored successfully.
     */
    public function store(UploadedFile $file, string $directory, ?string $oldPath = null): string
    {
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'jpg';

        $image = $this->manager->read($file->getRealPath());

        $image->scaleDown(
            width: config('media.max_width'),
            height: config('media.max_height'),
        );

        $encoded = $image->encodeByExtension($extension, quality: config('media.quality'));

        $path = trim($directory, '/').'/'.Str::uuid().'.'.$extension;

        Storage::disk('public')->put($path, (string) $encoded);

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return $path;
    }
}

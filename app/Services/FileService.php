<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function save($file, string $path, string $name): string
    {
        Storage::disk(env('FILESYSTEM_DISK'))->putFileAs(
            $path,
            $file,
            $name,
            'public'
        );

        return Storage::disk(env('FILESYSTEM_DISK'))->url($path . '/' . $name);
    }
}

<?php

use \Illuminate\Http\UploadedFile;
use \Illuminate\Support\Str;

function UploadFile(String $folder, UploadedFile $file)
{
    if (!$file || !$file->isValid()) {
        return null;
    }

    $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
    $file->storeAs($folder, $filename, 'public');

    return $filename;
}

function DeleteFile(String $folder, String $filename): bool
{
    $path = public_path('storage/' . $folder . '/' . $filename);

    if (file_exists($path)) {
        return unlink($path);
    }

    return false; 
}


<?php

use \Illuminate\Http\UploadedFile;

function UploadFile(String $folder, UploadedFile $file): String
{
    if (!$file || !$file->isValid()) {
        return null;
    }

    $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
    $file->storeAs($folder, $filename, 'public');

    return $filename;
}

function DeleteFile(String $folder, UploadedFile $filename): bool
{
    $path = public_path('storage/' . $folder . '/' . $filename);

    if (file_exists($path)) {
        return unlink($path);
    }

    return false; 
}


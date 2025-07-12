<?php

use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function UploadFile(String $folder, UploadedFile $file): String
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

function GetFile(?String $folder, ?String $filename): ?String
{
    if (empty($folder) || empty($filename)) {
        return null; 
    }

    $path = $folder ? "$folder/$filename" : $filename;

    if (!Storage::disk('public')->exists($path)) {
        return null;
    }

    return asset("storage/$path"); 
}


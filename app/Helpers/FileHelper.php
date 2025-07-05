<?php

function UploadFile($file, $folder)
{
    if (!$file || !$file->isValid()) {
        return null;
    }

    $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
    $file->storeAs($folder, $filename, 'public');

    return $filename;
}

function DeleteFile($folder, $filename)
{
    $path = public_path('storage/' . $folder . '/' . $filename);
    if (file_exists($path)) {
        unlink($path);
    }
}


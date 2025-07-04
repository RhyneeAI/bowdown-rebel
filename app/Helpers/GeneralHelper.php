<?php

function upload($file, $folder)
{
    if (!$file || !$file->isValid()) {
        return null;
    }

    $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
    $file->storeAs($folder, $filename, 'public');

    return $filename;
}

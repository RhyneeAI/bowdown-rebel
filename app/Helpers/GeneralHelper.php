<?php

function MakeSlug(String $text, String $separator = '-'): String
{
    $slug = strtolower($text);
    $slug = preg_replace('/[\s_]+/', $separator, $slug);
    $slug = preg_replace('/[^a-z0-9' . preg_quote($separator, '/') . ']/', '', $slug);
    $slug = trim($slug, $separator);
    $slug = preg_replace('/' . preg_quote($separator, '/') . '+/', $separator, $slug);

    return $slug;
}

function GetStatusProduk(String $statusCode): String {
    $status = ['Tidak Aktif', 'Aktif'];
    $index = (int) $statusCode;

    return $status[$index];
}


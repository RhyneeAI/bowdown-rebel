<?php

function MakeSlug($text, $separator = '-')
{
    $slug = strtolower($text);
    $slug = preg_replace('/[\s_]+/', $separator, $slug);
    $slug = preg_replace('/[^a-z0-9' . preg_quote($separator, '/') . ']/', '', $slug);
    $slug = trim($slug, $separator);
    $slug = preg_replace('/' . preg_quote($separator, '/') . '+/', $separator, $slug);

    return $slug;
}


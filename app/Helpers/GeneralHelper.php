<?php

function MakeSlug(String $text, String $separator = '-')
{
    $slug = strtolower($text);
    $slug = preg_replace('/[\s_]+/', $separator, $slug);
    $slug = preg_replace('/[^a-z0-9' . preg_quote($separator, '/') . ']/', '', $slug);
    $slug = trim($slug, $separator);
    $slug = preg_replace('/' . preg_quote($separator, '/') . '+/', $separator, $slug);

    return 'br' . RandomString(3) . '-' . $slug;
}

function RandomString($length = 6) {
    $characters = '0123456789';
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $result;
}

function GetStatusProduk(String $statusCode): String {
    $status = ['Tidak Aktif', 'Aktif'];
    $index = (int) $statusCode;

    return $status[$index];
}

function GetCartCount($id_user = '')
{
    $cart = App\Models\Cart::where('id_user', $id_user)->first();
    return $cart ? $cart->cartItems()->count() : 0;
}


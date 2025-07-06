<?php 

function ParseRupiah(String $rupiah)
{
    return (int) str_replace('.', '', $rupiah);
}

function FormatRupiah(int $number): String
{
    return number_format($number, 0, ',', '.');
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'keranjang_item';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_keranjang',
        'id_produk',
        'qty',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_keranjang');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}

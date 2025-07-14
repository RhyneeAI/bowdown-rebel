<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductPhoto;
use App\Models\ProductLiked;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CheckoutDetail extends Model
{
    protected $table = 'detail_checkout';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_produk',
        'id_checkout',
        'qty',
        'harga_satuan',
        'harga_subtotal',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'id_checkout');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
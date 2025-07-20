<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItems extends Model
{
    use HasFactory;
    protected $table = 'keranjang_item';
    protected $fillable = ['id_keranjang', 'id_produk', 'id_varian_produk', 'qty', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    /**
     * Get the cart that owns the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_keranjang', 'id');
    }
    /**
     * Get the product that owns the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }
    /**
     * Get the variant product that owns the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variantProduct()
    {
        return $this->belongsTo(ProductVariant::class, 'id_varian_produk', 'id');
    }
}

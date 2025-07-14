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

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';
    protected $fillable = ['nama_produk', 'id_kategori', 'slug', 'deskripsi', 'unggulan', 'rating', 'status'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id')
            ->select(['id', 'nama_kategori', 'slug']); 
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'id_produk', 'id')
            ->select(['id', 'id_produk', 'ukuran', 'harga', 'stok', 'min_stok']);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class, 'id_produk', 'id')
            ->select(['id', 'id_produk', 'nama_hash']);
    }

    public function photo(): HasOne
    {
        return $this->hasOne(ProductPhoto::class, 'id_produk', 'id')
            ->oldest()
            ->select(['id', 'id_produk', 'nama_hash']);
    }

    public function likedProducts(): HasMany
    {
        return $this->hasMany(ProductLiked::class, 'id_produk', 'id')
            ->select(['id', 'id_produk', 'id_user']);
    }

    public function likedProduct(): HasOne
    {
        return $this->hasOne(ProductLiked::class, 'id_produk', 'id')
            ->where('id_user', auth()->id()) 
            ->select(['id', 'id_produk', 'id_user']);
    }
}

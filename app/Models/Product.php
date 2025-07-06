<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductPhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';
    protected $fillable = ['nama_produk', 'id_kategori', 'slug', 'deskripsi', 'unggulan', 'status'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }

    public function variant(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'id_produk', 'id');
    }

    public function photo(): HasMany
    {
        return $this->hasMany(ProductPhoto::class, 'id_produk', 'id');
    }
}

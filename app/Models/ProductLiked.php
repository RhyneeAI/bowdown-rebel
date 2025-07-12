<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLiked extends Model
{
    use HasFactory;
    protected $table = 'produk_disukai';
    protected $fillable = ['id_user', 'id_produk'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

   
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }
}

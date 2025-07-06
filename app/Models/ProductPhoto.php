<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class ProductPhoto extends Model
{
    use HasFactory;
    
    protected $table = 'foto_produk';
    protected $fillable = ['id_produk', 'nama_asli', 'nama_hash', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the FotoProduk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }
}

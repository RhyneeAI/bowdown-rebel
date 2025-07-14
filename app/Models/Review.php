<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $fillable = ['id_user', 'id_produk', 'rating', 'komentar', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }
}

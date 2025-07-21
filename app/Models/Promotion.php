<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductPhoto;
use App\Models\ProductLiked;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use SoftDeletes;

    protected $table = 'promosi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'kode_promosi',
        'stok',
        'diskon_harga',
        'tanggal_mulai',
        'tanggal_berakhir',
        'foto',
        'slug',
        'created_at',
        'updated_at'
    ];

    public function promotionUsed(): HasMany
    {
        return $this->hasMany(PromotionUsed::class, 'id_promosi', 'id');
    }

    public function usedBy(): HasMany
    {
        return $this->hasMany(PromotionUsed::class, 'id_promosi');
    }
}

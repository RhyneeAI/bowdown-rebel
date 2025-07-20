<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = "promosi";
    protected $fillable = ['nama_promosi','kode_promosi','stok','diskon_harga','tanggal_mulai','tanggal_berakhir','foto','slug','created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function promotionUsed(): HasMany
    {
        return $this->hasMany(PromotionUsed::class, 'id_promosi', 'id');
    }
}

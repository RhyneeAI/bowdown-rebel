<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionUsed extends Model
{
    use HasFactory;

    protected $table = "promosi_dipakai";
    protected $fillable = ['id_promosi', 'id_user','created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'id_promosi', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

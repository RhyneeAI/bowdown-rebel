<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PromotionUsed extends Model
{
    use SoftDeletes;

    protected $table = 'promosi_dipakai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_promosi',
        'id_user',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'id_promosi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
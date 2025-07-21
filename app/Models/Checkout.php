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

class Checkout extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_ekspedisi',
        'no_faktur',
        'total_harga',
        'diskon',
        'dibayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function expedition()
    {
        return $this->belongsTo(Expedition::class, 'id_ekspedisi');
    }

    public function checkoutDetail()
    {
        return $this->hasMany(CheckoutDetail::class, 'id_checkout');
    }

    public function checkoutManagement()
    {
        return $this->hasMany(CheckoutManagement::class, 'id_checkout');
    }

    public function latestStatus()
    {
        return $this->checkoutManagement()->orderBy('tanggal_status', 'DESC')->first();
    }
}
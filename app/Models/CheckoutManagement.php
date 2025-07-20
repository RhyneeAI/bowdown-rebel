<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckoutManagement extends Model
{
    protected $table = 'manajemen_checkout';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_checkout',
        'status',
        'tanggal_status',
    ];

    /**
     * Relasi ke model Checkout.
     */
    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'id_checkout');
    }
}
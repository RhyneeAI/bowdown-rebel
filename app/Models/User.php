<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cart;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'id_role',
        'email',
        'password',
        'no_hp',
        'foto',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'email_verified_at', 'remember_token'
    ];

    
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(UserAddress::class, 'id_user', 'id')->where('is_main', 1);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'id_user', 'id');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'id_user', 'id');
    }

}

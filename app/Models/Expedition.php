<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expedition extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = "ekspedisi";
    protected $fillable = ['nama_ekspedisi', 'biaya', 'link_ekspedisi'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}

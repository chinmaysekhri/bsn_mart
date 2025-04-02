<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class purchasereturn extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
        
        'seller_id',
        'created_by',
        'product_id',
        'warehouse_name',
        'product_name',
        'product_quantity',
        'product_price',
        'single_product_total',
        'sub_total',
        'service_fees',
        'total',
        'status',
    ];
}

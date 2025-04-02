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


class Purchasereturn extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
	
	    'seller_id',
        'created_by',
        'product_id',
        'purchase_returns_id',
		'purchase_date',
        'warehouse_name',
        'product_name',
        'product_quantity',
        'product_price',
		'purchase_subtotal',
        'purchase_service_fee',
        'purchase_final_total',
        'total_product_price',
        'status',
	  ];	
}

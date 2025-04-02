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

class CartReturn extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
	 protected $fillable = [	
        'cart_return_id',
        'seller_id',
        'buyer_seller_id',
        'created_by',
		'product_id',
        'transaction_type',
        'product_name',
        'product_guarantee_type',
        'product_warranty_type',
        'return_date',
        'product_qty',
		'product_quantity',
		'product_total_qty',
        'unit_price',
		'product_total_price',
        'master_packing',
        'return_quantity',
        'return_price',
        'cartreturn_product_detail',
        'product_photo',
        'cart_product_detail',
        'subtotal_price',
        'shipping_estimate',
        'total_buy_price',
		'return_lr_date',
        'return_lr_no',
        'return_lr_copy',
        'return_lr_comment',
        'dispatched_lr_date',
        'dispatched_lr_no',
        'dispatched_lr_copy',
		'brand_name',
		'first_name',
		'last_name',
        'mobile',
        'email',
        'status',	
        'cart_return_status',	
    ];
}

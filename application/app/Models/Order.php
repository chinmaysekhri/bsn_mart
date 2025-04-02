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

class Order extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
	
        'order_id',
        'buyer_seller_id',
        'buyer_id',
        'seller_id',
        'created_by',
        'transaction_type',
        'product_name',
        'product_id',
        'cart_product_detail',
        'prod_qty',
        'single_prod_sub_total',
        'unit_price',
        'master_packing',
        'subtotal_price',
        'shipping_estimate',
        'total_buy_price',
        'order_quantity',
        'order_price',
		'first_name',
		'last_name',
        'mobile',
        'email',
        'present_address',
        'private_marka',
        'transport_name',
        'transport_address',
        'transport_address_name',
        'transport_contact_number',
        'delivery_place',
        'lr_copy_upload',
        'status',
        'order_status',
        'order_update_date',
        'lr_number',
        'upload_lr_receipt',
        'order_status_comment',
       
		
    ];
}

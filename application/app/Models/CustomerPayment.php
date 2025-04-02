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
class CustomerPayment extends Model
{
     use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
     protected $fillable = [
        'customer_id',
		'created_by',
		'managed_by',
        'product_id',
        'product_name',
        'slot',
        'investment',
        'guaranteed_profit',
        'gst_no',
        'total',
        'discount',
        'final_cost_of_product',
        'status',
        'follow_up_date',
        'feedback',
        'amount_paid',
        'payment_receipt_no',
        'payment_receipt',
        'payment_order_id',
        'payment_status',
    ];
}

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

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
	 protected $fillable = [
        'lead_id',
        'created_by',
        'managed_by',
		'first_name',
        'last_name',
        'mobile',
        'email',
        'present_address',
        'pin_code',
        'city',
        'state',
        'country',
        'product_type',
        'investment',
        'slot',
        'product_name',
        'product_photo',
        'guaranteed_profit',
        'gst_no',
        'total',
        'discount',
        'final_cost_of_product',
        'feedback',
        'status',
        'follow_up_date',
        'amount_paid',
        'payment_receipt_no',
        'payment_receipt',
        'payment_status',
       
    ];
}

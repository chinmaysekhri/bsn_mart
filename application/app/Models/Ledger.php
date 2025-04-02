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

class Ledger extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
	
        'created_by',
        'cart_return_id',
        'order_id',
        'fund_id',
        'withdrawal_id',
        'purchase_id',
		'purchase_return_id',
        'product_id',
        'buyer_seller_id',
        'ledger_order_id',
        'ledger_type',
        'ledger_for',
        'ledger_date',
        'ledger_amount',
        'status',
       
		
    ];
}
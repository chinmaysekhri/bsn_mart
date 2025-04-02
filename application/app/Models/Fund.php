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

class Fund extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'created_by',
        'cart_return_id',
        'payment_fund_id',
        'purchases_id',
        'fund_to',
		'fund_for',
		'fund_type',
        'fund_date',
        'fund_amount',
        'fund_receipt_no',
		'upload_fund_receipt',
        'status',
        'comment',
        'fund_status',
    ];
}

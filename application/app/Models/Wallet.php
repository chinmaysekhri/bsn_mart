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


class Wallet extends Model
{
    use HasFactory;
	
	    protected $fillable = [
        'created_by',
        'seller_id',
        'buyer_id',
		'credit_amount',
		'debit_amount',
		'total_wallet_amount',
        'status',   
        'deleted_at',
    ];
}

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

class Withdrawal extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'created_by',
        'verified_by',
        'payment_withdrawal_id',
        'purchase_returns_id',
        'withdrawal_for',
        'withdrawal_from',
        'withdrawal_type',
        'withdrawal_date',
        'withdrawal_request_amount',
        'withdrawal_amount',
        'account_paid_amount',
        'withdrawal_payment_type',
        'withdrawal_receipt_no',
        'upload_withdrawal_receipt',
        'withdrawal_comment',
        'acount_holder_name',
        'bank_name',
        'bank_account_no',
        'bank_ifsc_code',
        'status',
        'withdrawal_status',
    ];
}

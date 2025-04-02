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

class WithdrawalComment extends Model
{
     use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
     protected $fillable = [
        'withdrawal_id',
		'created_by',
		'withdrawal_request_date',
        'withdrawal_amount',
        'withdrawal_receipt_no',
        'upload_withdrawal_receipt',
        'withdrawal_comment',
        'withdrawal_status',
        'status',
    ];
}

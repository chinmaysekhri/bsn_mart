<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyerapplication extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


       protected $fillable = [
        
		'managed_by',
        'created_by',
        'first_name',
		'last_name',
        'mobile',
        'email',
        'gender',
        'present_address',
        'pin_code',
        'country',
        'state',
        'city',
        'district',
        'status', 
        'web_status',
        'deleted_at',
    ];
}

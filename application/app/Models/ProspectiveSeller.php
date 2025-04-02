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

class ProspectiveSeller extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

       protected $fillable = [	
        'date_of_enrollment',
        'category_id',
        'managed_by',
        'created_by',
        'updated_by',
        'assign_to',
        'app_seller_id',
        'assign_by',
        'data_from',
        'web_status',
        'business_name',
        'brand_name',
        'email',
        'contact',
		'first_name',
        'last_name',
		'gender',
        'present_address',
        'pin_code',
        'country',
        'state',
        'city',
        'comment',
        'next_action_date',
        'status_name', 
        'seller_type',
        'deals_in',
        'deleted_at',
    ];
}

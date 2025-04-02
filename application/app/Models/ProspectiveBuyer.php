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

class ProspectiveBuyer extends Model
{
       use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


       protected $fillable = [
        'date_of_enrollment',
        'category_id',
        'assign_to',
        'app_buyer_id',
        'assign_by',
        'data_from',
        'first_comment',
        'created_by',
        'updated_by',
        'business_name',
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
        'web_status',
        'status_name' , 
        'deleted_at',

    ];
}

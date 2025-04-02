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

class Seller extends Model
{
      use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


       protected $fillable = [
        
		'emp_id',
        'category_id',
		'managed_by',
        'designation',
		'created_by',
        'date_of_enrollment',
        'category_id',
        'business_name',
        'brand_name',
        'brand_registration_upload',
        'seller_brand_logo',
        'for',
        'email',
        'contact',
        'address',
		'first_name',
        'last_name',
        'mobile',
        'profile_img',
        'contract_img',
		'gender',
        'aadhar_no',
        'upload_aadhar_no',
        'pan_no',
        'upload_pan_no',
        'gst_no',
        'upload_gst_no',
        'present_address',
        'pin_code',
        'country',
        'state',
        'district',
        'city',
		'bank_name',
        'ifsc_code',
        'account_no',
        'cheque_copy',
        'password',
        'confirm_password',
        'status',   
        'black_listed_district',   
        'deleted_at',
    ];


}

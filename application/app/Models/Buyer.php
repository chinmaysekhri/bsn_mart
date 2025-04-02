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

class Buyer extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


       protected $fillable = [
        'company_id',
        'customer_id',
		'emp_id',
		'managed_by',
		'created_by',
        'date_of_enrollment',
        'category_id',
        'business_name',
        'for',
        'name',
        'email',
        'contact',
        'alt_contact',
        'present_address',
        'state',
        'pin_code',
        'city',
        'country',
        'district',
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
        'permanent_address',
		'bank_name',
        'ifsc_code',
        'account_no',
        'cheque_copy',
        'password',
        'confirm_password',
        'status',   
        'deleted_at',
    ];
}

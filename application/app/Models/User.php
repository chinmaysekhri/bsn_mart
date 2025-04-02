<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'company_id',
        'customer_id',
		'emp_id',
		'managed_by',
		'created_by',
        'seller_id',
        'buyer_id',
        'date_of_enrollment',
        'total_invested',
        'for',
        'designation',
        'salary',
        'name',
        'email',
        'official_email',
        'official_password',
        'official_contact',
        'contact',
        'alt_contact',
        'address',
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
        'black_listed_district',
        'status',   
        'deleted_at',
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
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

class Company extends Model
{
	use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
     protected $fillable = [
        'date_of_incorporation',
        'company_name',
        'mobile',
        'profile_img',
        'company_email',
        'coi',
        'mca_llp',
        'pan_card',
        'gst_certificate',
        'rent_agrement',
        'moa',
        'msme_certificate',
        'aoa',
        'tan_no',
        'pf_no',
        'esi_no',
        'ngo_darpan',
        'iso_certificate',
        'dipp',
        'bank_name',
        'ifsc_code',
        'account_no',
        'cheque_copy',
        'account_login_url',
        'user_id',
        'company_password',
        'managed_by',
        'created_by',
        'status',
    ];
}

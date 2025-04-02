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


class Employee extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
   
       /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'created_by',
        'emp_id',
        'date_of_joining',
        'managed_by',
        'designation',
        'first_name',
        'last_name',
        'mobile',
		'profile_img',
        'email',
        'official_email',
        'official_password',
        'official_contact',
        'gender',
        'salary',
        'resume',
        'esi_no',
        'present_address',
        'pin_code',
        'country',
        'state',
        'district',
        'city',
        'permanent_address',
        'aadhar_no',
        'upload_aadhar_no',
        'pan_no',
        'upload_pan_no',
        'uan_no',
        'qualification',
        'ten_passing_year',
        'ten_mark_percentage',
        'ten_board_school',
        'ten_board_school_document',
        'twelve_passing_year',
        'twelve_mark_percentage',
        'twelve_board_school',
        'twelve_board_school_document',
        'graduate_passing_year',
        'graduate_mark_percentage',
        'graduate_board_school',
        'graduate_board_school_document',
        'post_graduate_passing_year',
        'post_graduate_mark_percentage',
        'post_graduate_board_school',
        'post_graduate_board_school_document',
        'phd_passing_year',
        'phd_mark_percentage',
        'phd_board_school',
        'phd_board_school_document',
        'company_name',
        'from_company_duration',
        'to_company_duration',
        'company_ctc',
        'company_offer_letter',
        'company_relieving_letter',
        'salary_slip_first',
        'salary_slip_second',
        'salary_slip_third',
        'other_company_name',
        'other_from_duration',
        'other_to_duration',
        'other_company_ctc',
        'other_offer_letter',
        'other_relieving_letter',
        'other_company_offer_letter',
        'other_document_name',
        'other_upload_document',
        'comment',
        'status',
        'final_verified', 
    ];
   
   
}

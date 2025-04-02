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

class ProspectiveSellerComment extends Model
{
     use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

     protected $fillable = [
        'prospectiveseller_id',
		'created_by',
		'updated_by',
        'comment',
        'next_action_date',
        'status_name',
        'date_of_enrollment',
    ];
}

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

class ProductComment extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
     protected $fillable = [
        'product_id',
		'created_by',
        'comment',
        'managed_by',
        'status',
    ];
}

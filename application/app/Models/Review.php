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

class Review extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
	 protected $fillable = [	
        'buyer_seller_id',
        'created_by',
		'product_id',
        'review_rating',
        'review_comment',
        'status',	
       	
    ];
}

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

class SuggestProduct extends Model
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
	
    protected $fillable = [
        'created_by',
        'suggest_product_name',
        'suggest_price_range',
        'suggest_brand_name',
        'monthly_requirement',
        'suggest_product_img',
        'comment',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        
        
    ];
}

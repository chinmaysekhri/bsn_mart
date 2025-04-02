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

class SubCategories extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
       protected $table = 'subcategories';
         
       protected $fillable = [
        'created_by',
        'sub_category_name',
        'created_by',
        'category_id',
        'deleted_at',
    ];
}

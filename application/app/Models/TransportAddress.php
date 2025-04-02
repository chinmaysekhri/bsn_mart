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


class TransportAddress extends Model
{
       use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
         
       protected $fillable = [
        'buyer_id',
        'private_marka',
        'transport_name',
        'transport_address',
        'transport_address_name',
        'transport_contact_number',
        'delivery_place',
        'lr_copy_upload',
      'created_by',
        'deleted_at',
    ];
}

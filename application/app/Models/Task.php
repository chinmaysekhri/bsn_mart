<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Task extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
	
     protected $fillable = [
        'task_assign_to',
        'task_assign_by',
        'task_title',
        'task_detail',
        'task_comment',
        'task_close_date',
        'managed_by',
        'created_by',
        'status',
    ];
}

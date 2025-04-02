<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducationDetail extends Model
{
    use HasFactory;
	
	    protected $fillable = [
        'emp_id',
        'qualification',
        'passing_year',
        'mark_percentage',
        'board_name',
        'attached_document',
    ];
	
	
}

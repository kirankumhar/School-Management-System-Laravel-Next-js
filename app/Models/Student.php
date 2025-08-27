<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'roll_number',
        'class',
        'section',
        'date_of_birth',
        'address',
        'profile_image',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
    
}

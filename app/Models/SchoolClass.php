<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'numeric_name',
        'description',
        'capacity',
        'class_teacher_id'
    ];

    // Relationship with sections
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    // Relationship with class teacher
    public function classTeacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'class_teacher_id');
    }

    // Relationship with students (through sections)
    public function students()
    {
        return $this->hasManyThrough(Student::class, Section::class);
    }

    // Get total students in class
    public function getTotalStudentsAttribute()
    {
        return $this->sections->sum('student_count');
    }
}

<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name'
    ];

    protected $appends = [
        'teacher_name'
    ];

    public function students() : HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teacher() : BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function assign_teacher(Teacher $teacher)
    {
        return $this->teacher()->associate($teacher);
    }

    public function getStudentCountAttribute()
    {
        return $this->students()->count();
    }

    public function getTeacherNameAttribute()
    {
        if($this->teacher)
        {
            return $this->teacher->lastname.", ".$this->teacher->firstname." ".$this->teacher->middlename;
        }

        return "(No Teacher Assigned)";
    }
}

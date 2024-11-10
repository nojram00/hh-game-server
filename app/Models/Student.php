<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'pre_test_score',
        'post_test_score',
        'tera_mastery',
        'ecology_mastery',
        'momentum_mastery',
        'quantum_mastery'
    ];

    protected $appends = [ 'name' ];

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assign_user(User $user)
    {
        if($user->role == User::ROLES['2'])
        {
            return $this->user()->associate($user);
        }
    }

    public function assign_section(Section $section)
    {
        return $this->section()->associate($section);
    }

    public function getNameAttribute()
    {
        return $this->lastname.", ".$this->firstname." ".$this->middlename;
    }
}

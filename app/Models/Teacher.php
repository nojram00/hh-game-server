<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;

    public function section() : HasOne
    {
        return $this->hasOne(Section::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assign_user(User $user)
    {
        if($user->role == User::ROLES['1'])
        {
            return $this->user()->associate($user);
        }
    }
}

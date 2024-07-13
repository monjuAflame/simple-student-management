<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'gender',
        'address',
        'dob',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enrolments(): BelongsTo
    {
        return $this->user->enrolments;
    }

    public function getFullNameAttribute(): string
    {
        return $this->user?->first_name . ' ' . $this->user?->last_name ?? '';
    }

    public function enrolmentCourseIDs()
    {
        return $this->user->enrolments->pluck('course_id')->toArray();
    }
}

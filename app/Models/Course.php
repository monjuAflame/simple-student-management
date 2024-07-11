<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'fee',
        'course_type',
        'creator_id',
        'status',
    ];

    public const ADMISSION_TYPE_ADMISSION = 'admission';

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrolments', 'course_id', 'user_id')
            ->withTimestamps()
            ->withPivot(['admission_type', 'discount']);
    }

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class, 'course_id');
    }
}

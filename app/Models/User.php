<?php

namespace App\Models;

use Exception;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'avatar',
        'password',
        'role_id',
        'creator_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roleList(): array
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == self::ADMIN) {
            return [
                2 => 'Author',
                3 => 'Student',
            ];
        }
        if ($role_id == self::AUTHOR) {
            return [
                3 => 'Student',
            ];
        }

        return [];
    }

    public const ADMIN = 1;
    public const AUTHOR = 2;
    public const STUDENT = 3;

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrolments', 'user_id', 'course_id')
            ->withTimestamps()
            ->withPivot(['id', 'admission_type', 'discount']);
    }

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class, 'user_id');
    }

    public static function createNew($data)
    {
        try {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'role_id' => User::STUDENT,
                'status' => true,
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }
}

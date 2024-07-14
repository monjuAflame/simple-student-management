<?php

namespace App\Models;

use Exception;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    function getRoleNameAttribute(): ?string
    {
        return [
            self::ADMIN => 'Admin',
            self::AUTHOR => 'Author',
            self::STUDENT => 'Student',
        ][$this->role_id] ?? null;
    }

    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrolments', 'user_id', 'course_id')
            ->withTimestamps()
            ->withPivot(['id', 'admission_type', 'discount']);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function enrolments(): HasMany
    {
        return $this->hasMany(Enrolment::class, 'user_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function status(): void
    {
        $this->staus == 1 ? 'Active' : 'Deactive';
    }
}

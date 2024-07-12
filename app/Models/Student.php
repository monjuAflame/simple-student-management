<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function createNew($data, User $user)
    {
        try {
            return Student::create([
                'user_id' => $user['id'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'student_id' => config('app.id_prefix') . (Student::count() + 1),
                'address' => $data['address'],
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }
}

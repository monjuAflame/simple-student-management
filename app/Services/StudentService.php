<?php

namespace App\Services;

use Exception;
use App\Caches\PerStudentCache;
use App\Models\Student;

class StudentService
{
    public function store($data, $user_id)
    {
        try {
            $data['user_id'] = $user_id;
            $data['student_id'] = config('app.id_prefix') . '' . (Student::count() + 1);

            return Student::create($data);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }

    public function update($data, Student $student)
    {
        return $student->update($data);
    }
}

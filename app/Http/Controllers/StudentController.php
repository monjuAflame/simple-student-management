<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use App\Services\UserService;
use Exception;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user:id,first_name,last_name,email,status')
            ->select('id', 'student_id', 'gender', 'user_id')
            ->get();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('student.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        $user = (new UserService)->store($data);
        if ($user == null) {
            return $this->returnFailedResponse();
        }

        $student = (new StudentService)->store($data, $user->id);
        if ($student == null) {
            $user->forceDelete();
            return $this->returnFailedResponse();
        }

        try {
            $user->enrolledCourses()->attach($data['course_id'], [
                'discount' => 0,
            ]);

            return redirect()->route('students.index')->with(['message' => 'Student Successfully Created!']);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {

        $student->load(['user:id,first_name,last_name,phone,email,status']);
        $courses = Course::select('id', 'name')->get();
        return view('student.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        $user = (new \App\Services\UserService())->update($data, $student->load('user')->user);
        if ($user == null) {
            return $this->returnFailedResponse();
        }

        $student = (new \App\Services\StudentService())->update($data, $student);
        if ($student == null) {
            return $this->returnFailedResponse();
        }

        try {
            $user->enrolledCourses()->syncWithPivotValues($data['course_id'], [
                'discount' => 0,
            ]);

            return redirect()->back()->with(['message' => 'Student Successfully Updated!']);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->user->delete();

            return redirect()->back()->with(['message' => 'Student Successfully Deleted!']);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }

    private function returnFailedResponse($message = null)
    {
        $message = $message ?? 'Something went wrong!';
        return back()->withInput()->with('error', $message);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.index');
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

        $user = User::createNew($data);
        if ($user == null) {
            return $this->returnFailedResponse();
        }

        $student = Student::createNew($data, $user);

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
            logger($e->getTraceAsString());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    private function returnFailedResponse($message = null)
    {
        $message = $message ?? 'Something went wrong!';
        return back()->withInput()->with('error', $message);
    }
}

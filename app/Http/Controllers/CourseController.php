<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::select('id', 'name', 'code', 'fee', 'course_type', 'status')
            ->get();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            Course::create($request->validated());

            return redirect()->route('courses.index')->with(['message' => 'Course Successfully Created!']);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        try {

            $course->name = $data['name'];
            $course->code = $data['code'];
            $course->fee = $data['fee'];
            $course->save();


            return redirect()->route('courses.index')->with(['message' => 'Course Successfully Updated!']);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();

            return redirect()->back()->with(['message' => 'Course Successfully Deleted!']);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }
}

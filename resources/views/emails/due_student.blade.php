<!DOCTYPE html>
<html>
<head>
    <title>Due Student</title>
</head>
<body>
    <p>Name: {{ $data->user->student->fullName }}</p>
    <p>Student ID: {{ $data->user->student->student_id }}</p>
    <p>Course Name: {{ $data->enrolment->course->name }}</p>
    <p>Course Fee: {{ $data->course_fee }}</p>
    <p>Paid Amount: {{ $data->total_paid }}</p>
    <p>Due Amount: {{ $data->due }}</p>
</body>
</html>
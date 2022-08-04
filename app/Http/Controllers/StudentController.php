<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('teacher')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('students.create', compact('teachers'));
    }

    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    public function edit(Student $student)
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('students.edit', compact('student', 'teachers'));
    }

    public function update(StoreStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarkRequest;
use App\Models\Mark;
use App\Models\Student;

class MarkController extends Controller
{
    public function index()
    {
        $marks = Mark::with('student')->latest()->paginate(10);
        return view('marks.index', compact('marks'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        return view('marks.create', compact('students'));
    }

    public function store(StoreMarkRequest $request)
    {
        $total = $request->science + $request->history + $request->maths;
        Mark::create(array_merge($request->validated(), ['total' => $total]));

        return redirect()
            ->route('marks.index')
            ->with('success', 'Marks added successfully!');
    }

    public function edit(Mark $mark)
    {
        $students = Student::orderBy('name')->get();
        return view('marks.edit', compact('mark', 'students'));
    }

    public function update(StoreMarkRequest $request, Mark $mark)
    {
        $total = $request->science + $request->history + $request->maths;

        $mark->update(array_merge($request->validated(), ['total' => $total]));

        return redirect()
            ->route('marks.index')
            ->with('success', 'Marks updated successfully!');
    }

    public function destroy(Mark $mark)
    {
        $mark->delete();

        return redirect()
            ->route('marks.index')
            ->with('success', 'Marks deleted successfully!');
    }
}

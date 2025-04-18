<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('students')->get();
        $enrolled = auth()->user()->enrolledSubjects->pluck('id')->toArray();

        return view('student.subjects.index', compact('subjects', 'enrolled'));
    }

    public function join(Subject $subject)
    {
        auth()->user()->enrolledSubjects()->attach($subject);
        return back()->with('success', 'You joined the subject.');
    }

    public function leave(Subject $subject)
    {
        auth()->user()->enrolledSubjects()->detach($subject);
        return back()->with('success', 'You left the subject.');
    }
    public function show(Subject $subject)
    {
        if (!auth()->user()->enrolledSubjects->contains($subject->id)) {
            abort(403, 'You are not enrolled in this subject.');
        }
        $tasks = $subject->tasks()->with('solutions')->get();

        return view('student.subjects.show', compact('subject', 'tasks'));
    }

}


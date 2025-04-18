<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function create(Task $task)
    {
        if (!auth()->user()->enrolledSubjects->contains($task->subject_id)) {
            abort(403);
        }

        return view('student.solutions.create', compact('task'));
    }

    public function store(Request $request, Task $task)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        auth()->user()->solutions()->create([
            'task_id' => $task->id,
            'content' => $request->content,
        ]);

        return redirect()->route('student.subjects.show', $task->subject)
                         ->with('success', 'Solution submitted successfully.');
    }
}

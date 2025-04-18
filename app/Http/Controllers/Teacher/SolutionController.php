<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index(Task $task)
    {
        abort_unless($task->subject->user_id === auth()->id(), 403);

        $solutions = $task->solutions()->with('student')->get();

        return view('teacher.solutions.index', compact('task', 'solutions'));
    }

    public function edit(Solution $solution)
    {
        $solution->load(['task', 'user']);

        abort_unless($solution->task->subject->user_id === auth()->id(), 403);

        return view('teacher.solutions.evaluate', compact('solution'));
    }

    public function update(Request $request, Solution $solution)
    {
        abort_unless($solution->task->subject->user_id === auth()->id(), 403);

        $maxPoints = $solution->task->points;

        $validated = $request->validate([
            'grade' => "required|integer|min:0|max:$maxPoints",
            'feedback' => 'nullable|string',
        ]);

        $solution->update([
            'grade' => $validated['grade'],
            'feedback' => $validated['feedback'] ?? null,
        ]);

        return redirect()
            ->route('teacher.tasks.show', $solution->task_id)
            ->with('success', 'Evaluation updated successfully.');
    }
}

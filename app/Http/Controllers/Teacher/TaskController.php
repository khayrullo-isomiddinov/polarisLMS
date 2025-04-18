<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;



class TaskController extends Controller
{
    public function index(Subject $subject)
    {
        abort_unless($subject->user_id === auth()->id(), 403);

        return view('teacher.tasks.index', [
            'subject' => $subject,
            'tasks' => $subject->tasks
        ]);
    }
    public function create(Subject $subject)
    {
        abort_unless($subject->user_id === auth()->id(), 403);
        return view('teacher.tasks.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject)
    {
        abort_unless($subject->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'points' => 'required|integer|min:1',
        ]);

        $subject->tasks()->create($validated);

        return redirect()->route('teacher.subjects.show', $subject)
                        ->with('success', 'Task created successfully.');
    }


    

    public function show(Task $task)
    {
        $task->load([
            'solutions.user'
        ]);

        $task->loadCount([
            'solutions',
            'solutions as evaluated_solutions_count' => fn($query) =>
                $query->whereNotNull('points')
        ]);

        return view('teacher.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_unless($task->subject->user_id === auth()->id(), 403);

        return view('teacher.tasks.edit', compact('task'));
    }


    public function update(Request $request, Task $task)
    {
        abort_unless($task->subject->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'points' => 'required|integer|min:1',
        ]);

        $task->update($validated);

        return redirect()
            ->route('teacher.subjects.tasks.index', $task->subject)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        abort_unless($task->subject->user_id === auth()->id(), 403);

        $task->delete();

        return redirect()
            ->route('teacher.subjects.tasks.index', $task->subject)
            ->with('success', 'Task deleted.');
    }

}

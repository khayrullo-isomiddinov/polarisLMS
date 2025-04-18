<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;



class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->withoutTrashed()
        ->get();

return view('teacher.subjects.index', compact('subjects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20',
            'credits' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);
        
        Subject::create([
            'name' => $request->name,
            'code' => $request->code,
            'credits' => $request->credits,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);
        

        return redirect()->route('teacher.subjects.index')->with('success', 'Subject created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $subject = Subject::with(['students'])->withCount('students')->findOrFail($id);
        return view('teacher.subjects.show', compact('subject'));
    }

    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        return view('teacher.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $subject = Subject::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:20',
        'credits' => 'required|integer|min:1',
        'description' => 'nullable|string',
    ]);

    $subject->update([
        'name' => $request->name,
        'code' => $request->code,
        'credits' => $request->credits,
        'description' => $request->description,
    ]);

    return redirect()->route('teacher.subjects.index')->with('success', 'Subject updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('teacher.subjects.index')->with('success', 'Subject deleted (soft delete).');
    }

}
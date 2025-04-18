<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\SubjectController as TeacherSubjectController;
use App\Http\Controllers\Teacher\TaskController;
use App\Http\Controllers\Student\SubjectController as StudentSubjectController;
use App\Http\Controllers\Student\SolutionController;
use App\Http\Controllers\Teacher\SolutionController as TeacherSolutionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::resource('subjects', TeacherSubjectController::class);
        Route::resource('subjects.tasks', TaskController::class)->shallow();
        Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('tasks/{task}/solutions', [TeacherSolutionController::class, 'index'])->name('tasks.solutions');
        Route::get('solutions/{solution}/edit', [TeacherSolutionController::class, 'edit'])->name('solutions.edit');
        Route::patch('solutions/{solution}', [TeacherSolutionController::class, 'update'])->name('solutions.update');
        Route::get('solutions/{solution}/edit', [TeacherSolutionController::class, 'edit'])->name('solutions.edit');
        Route::put('solutions/{solution}', [TeacherSolutionController::class, 'update'])->name('solutions.update');
    });

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('subjects', [StudentSubjectController::class, 'index'])->name('subjects.index');
        Route::post('subjects/{subject}/join', [StudentSubjectController::class, 'join'])->name('subjects.join');
        Route::post('subjects/{subject}/leave', [StudentSubjectController::class, 'leave'])->name('subjects.leave');
        Route::get('subjects/{subject}', [StudentSubjectController::class, 'show'])->name('subjects.show');
        Route::get('tasks/{task}/submit', [SolutionController::class, 'create'])->name('tasks.submit');
        Route::post('tasks/{task}/submit', [SolutionController::class, 'store'])->name('tasks.submit.store');
    });

Route::get('/dashboard', function () {
    $user = auth()->user();

    $subjects = match ($user->role) {
        'teacher' => $user->taughtSubjects,
        'student' => $user->subjects,
        default => collect(),
    };

    return view('dashboard', compact('subjects'));
})->middleware(['auth'])->name('dashboard');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

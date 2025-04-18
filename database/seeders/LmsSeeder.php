<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Support\Facades\Hash;

class LmsSeeder extends Seeder
{
    public function run(): void
    {
        // Create 1 teacher
        $teacher = User::create([
            'name' => 'Professor X',
            'email' => 'prof@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Create 2 students
        $student1 = User::create([
            'name' => 'Student One',
            'email' => 'student1@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student2 = User::create([
            'name' => 'Student Two',
            'email' => 'student2@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create a subject
        $subject = Subject::create([
            'name' => 'Web Development',
            'description' => 'Learn Laravel & Vue',
            'user_id' => $teacher->id,
        ]);

        // Attach students to the subject
        $subject->students()->attach([$student1->id, $student2->id]);

        // Create a task
        $task = Task::create([
            'subject_id' => $subject->id,
            'title' => 'Build a Blog',
            'description' => 'Create a basic blog using Laravel.',
            'deadline' => now()->addDays(7),
        ]);

        // Student1 submits a solution
        Solution::create([
            'task_id' => $task->id,
            'user_id' => $student1->id,
            'content' => 'My blog solution goes here...',
            'grade' => null,
        ]);
    }
}


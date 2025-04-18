<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Solutions for Task: {{ $task->title }}</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($solutions as $solution)
        <div class="bg-white p-4 mb-4 shadow rounded">
            <p><strong>Student:</strong> {{ $solution->student->name }}</p>
            <p><strong>Content:</strong> {{ $solution->content }}</p>
            <p><strong>Grade:</strong> {{ $solution->grade ?? 'Not graded yet' }}</p>
            <p><strong>Feedback:</strong> {{ $solution->feedback ?? 'No feedback yet' }}</p>
            <a href="{{ route('teacher.solutions.edit', $solution) }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">
                Grade this submission
            </a>
        </div>
    @empty
        <p class="text-gray-600">No submissions yet for this task.</p>
    @endforelse
</x-app-layout>

<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6 space-y-6">
        <h2 class="text-2xl font-extrabold text-white tracking-tight">Tasks for {{ $subject->name }}</h2>

        @if (session('success'))
        <div class="bg-green-100 text-green-900 px-4 py-2 rounded-lg shadow">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('teacher.subjects.tasks.create', $subject) }}"
            class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            Add Task
        </a>

        @forelse ($tasks as $task)
        <div
            class="bg-white/5 backdrop-blur-md border border-white/10 text-white rounded-2xl p-6 shadow-lg space-y-3 transition hover:scale-[1.01] hover:shadow-xl">
            <div class="flex justify-between items-start">
                <div>
                    <a href="{{ route('teacher.tasks.show', $task) }}"
                        class="text-xl font-semibold text-white hover:text-indigo-300 transition">
                        {{ $task->title }}
                    </a>

                    <p class="text-white/70 mt-1">{{ $task->description }}</p>
                </div>
                <span class="text-xs bg-indigo-500 text-white px-3 py-1 rounded-full shadow">Points:
                    {{ $task->points }}</span>
            </div>

            <div class="flex justify-between items-center mt-3">
                <span class="text-sm text-white/50">
                    Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('M j, Y') }}
                </span>

                <div class="space-x-4">
                    <a href="{{ route('teacher.tasks.edit', $task) }}"
                        class="text-indigo-300 hover:text-indigo-100 text-sm font-medium transition">
                        Edit
                    </a>

                    <form action="{{ route('teacher.tasks.destroy', $task) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-200 text-sm font-medium transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-white/50 italic">No tasks yet. Click "Add Task" to create one.</p>
        @endforelse
    </div>
</x-app-layout>
<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6 space-y-6 text-white">
        <h1 class="text-3xl font-extrabold">{{ $task->title }}</h1>

        <div class="space-y-4">
            <p class="text-white/80">{{ $task->description }}</p>

            <div class="space-y-1 text-sm text-white/60">
                <div><strong>Points:</strong> {{ $task->points }}</div>
                <div><strong>Deadline:</strong> {{ $task->deadline->format('M j, Y') }}</div>
                <div><strong>Submitted solutions:</strong> {{ $task->solutions_count }}</div>
                <div><strong>Evaluated solutions:</strong> {{ $task->evaluated_solutions_count }}</div>
            </div>
        </div>

        @if ($task->solutions->count())
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl shadow p-6 mt-10">
                <h3 class="text-xl font-semibold text-white mb-4">
                    Submitted Solutions ({{ $task->solutions_count }})
                </h3>

                <ul class="space-y-3 max-h-[300px] overflow-y-auto">
                    @foreach ($task->solutions as $solution)
                        <li class="bg-white/10 px-4 py-3 rounded-lg border border-white/10">
                            <div class="text-white font-medium">
                                {{ $solution->user->name }}
                                <span class="text-white/50">({{ $solution->user->email }})</span>
                            </div>
                            <div class="text-white/60 text-sm mt-1">
                                Submitted on: {{ $solution->created_at->format('M j, Y \a\t g:i A') }}
                            </div>

                            @if ($solution->points !== null)
                                <div class="text-green-400 text-sm mt-1">
                                    Evaluated: {{ $solution->points }} points
                                    <span class="text-white/50">
                                        ({{ $solution->updated_at->format('M j, Y \a\t g:i A') }})
                                    </span>
                                </div>
                            @else
                                <div class="text-yellow-400 text-sm mt-1 italic">Not yet evaluated</div>
                                <a href="{{ route('teacher.solutions.edit', $solution) }}"
                                   class="mt-2 inline-block px-4 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded transition">
                                    Evaluate →
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-white/50 italic mt-8">No solutions submitted yet.</p>
        @endif

        <a href="{{ url()->previous() }}" class="inline-block mt-6 text-indigo-400 hover:text-indigo-200 transition">
            ← Back
        </a>
    </div>
</x-app-layout>

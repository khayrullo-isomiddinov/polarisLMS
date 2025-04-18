<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 space-y-6">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Tasks for {{ $subject->name }}</h2>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-900 p-4 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($tasks as $task)
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-md transition hover:shadow-xl hover:scale-[1.01]">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">{{ $task->title }}</h3>
                    <span class="text-sm text-white/50">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}</span>
                </div>

                <p class="mt-2 text-white/70 leading-relaxed">{{ $task->description }}</p>

                @php
                    $submitted = $task->solutions->where('user_id', auth()->id())->first();
                @endphp

                <div class="mt-4">
                    @if ($submitted)
                        <div class="inline-block text-sm px-4 py-1 rounded-full bg-green-700/30 text-green-300 font-medium">
                            Already submitted
                        </div>
                    @else
                        <a href="{{ route('student.tasks.submit', $task) }}"
                           class="inline-block text-sm px-4 py-1 rounded-full bg-blue-700/30 text-blue-300 font-medium hover:bg-blue-600/40 hover:text-white transition">
                            Submit Solution →
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-white/50 italic text-center py-12">
                There are no tasks available for this subject yet.
            </div>
        @endforelse

        <div class="pt-8 text-center">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center text-sm font-medium px-5 py-2.5 bg-white/10 text-white hover:text-white/90 rounded-full border border-white/20 backdrop-blur-md shadow hover:shadow-lg transition">
                ← Back to Menu
            </a>
        </div>
    </div>
</x-app-layout>

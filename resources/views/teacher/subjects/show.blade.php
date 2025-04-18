<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-white tracking-tight">{{ $subject->name }}</h1>
                <div class="mt-2 flex flex-wrap gap-2">
                    <span class="bg-white/10 border border-white/20 backdrop-blur-sm text-xs uppercase text-white/80 px-3 py-1 rounded-full">
                        Code: <strong class="text-white">{{ $subject->code }}</strong>
                    </span>
                    <span class="bg-white/10 border border-white/20 backdrop-blur-sm text-xs uppercase text-white/80 px-3 py-1 rounded-full">
                        Credits: <strong class="text-white">{{ $subject->credits ?? '—' }}</strong>
                    </span>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('teacher.subjects.tasks.index', $subject) }}"
                   class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition">
                    View Tasks
                </a>

                <a href="{{ route(auth()->user()->role . '.subjects.index') }}"
                   class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg shadow transition">
                    All Subjects
                </a>

                <form method="POST" action="{{ route('teacher.subjects.destroy', $subject) }}"
                      onsubmit="return confirm('Are you sure you want to delete this subject?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition">
                        Delete Subject
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6 lg:px-8 max-w-5xl mx-auto space-y-8 relative">
       
        <div class="absolute -top-16 -left-16 w-80 h-80 bg-gradient-to-br from-purple-600 via-pink-500 to-yellow-400 rounded-full opacity-10 animate-pulse-slow"></div>
        <div class="absolute -bottom-16 -right-16 w-72 h-72 bg-gradient-to-tl from-indigo-700 via-blue-500 to-teal-400 rounded-full opacity-10 animate-pulse-slow-reverse"></div>
        <div class="relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-lg p-8 space-y-6">
            <section>
                <h2 class="text-2xl font-semibold text-green-200">Description</h2>
                <p class="mt-2 text-white/80 leading-relaxed">{{ $subject->description }}</p>
            </section>

            <section class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-green-200 uppercase tracking-wide">Credits</h4>
                    <p class="mt-1 text-white/80">{{ $subject->credits ?? '—' }}</p>
                </div>
                <div class="text-sm text-white/50 space-y-1">
                    <div>Created: {{ $subject->created_at->format('M j, Y') }}</div>
                    <div>Updated: {{ $subject->updated_at->format('M j, Y \a\t g:i A') }}</div>
                    <div>{{ $subject->students_count }} enrolled {{ Str::plural('student', $subject->students_count) }}</div>
                </div>
            </section>
        </div>

        @if ($subject->students_count > 0)
            <div class="relative bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl shadow p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Enrolled Students ({{ $subject->students_count }})</h3>
                <ul class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach ($subject->students as $student)
                        <li class="flex justify-between items-center bg-white/5 px-4 py-2 rounded-lg border border-white/10">
                            <div>
                                <span class="block font-medium text-white">{{ $student->name }}</span>
                                <span class="block text-xs text-white/60">{{ $student->email }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="text-white/50 italic">No students have enrolled in this subject yet.</div>
        @endif
    </div>

    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.1 }
            50% { opacity: 0.2 }
        }

        .animate-pulse-slow {
            animation: pulse-slow 8s ease-in-out infinite;
        }

        @keyframes pulse-slow-reverse {
            0%, 100% { opacity: 0.1 }
            50% { opacity: 0.2 }
        }

        .animate-pulse-slow-reverse {
            animation: pulse-slow-reverse 10s ease-in-out infinite;
        }
    </style>
</x-app-layout>

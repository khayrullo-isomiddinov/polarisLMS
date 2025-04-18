<x-app-layout>
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-white tracking-tight">My Subjects</h1>
    </x-slot>

    <div class="py-6 relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div
                class="absolute -top-16 -left-16 w-64 h-64 bg-gradient-to-br from-green-400 via-teal-300 to-blue-500 rounded-full opacity-10 animate-pulse-slow">
            </div>
            <div
                class="absolute -bottom-20 -right-16 w-80 h-80 bg-gradient-to-tr from-purple-600 via-pink-500 to-yellow-500 rounded-full opacity-10 animate-pulse-slow-reverse">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 z-10">
            <div class="flex justify-end">
                <a href="{{ route('teacher.subjects.create') }}"
                    class="inline-flex items-center px-5 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                    <span class="mr-2 text-lg"></span> Create New Subject
                </a>
            </div>

            @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-xl shadow-inner">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($subjects as $subject)
                <div
                    class="group relative rounded-2xl border border-white/10 bg-white/5 backdrop-blur-lg p-6 transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_0_40px_0_rgba(255,255,255,0.1)] hover:border-white/20 shadow-[inset_0_0_0_1px_rgba(255,255,255,0.05)]">

                    <div
                        class="absolute inset-0 rounded-2xl pointer-events-none group-hover:shadow-[0_0_30px_5px_rgba(0,255,255,0.2)] transition-all duration-500">
                    </div>

                    <h2 class="text-2xl font-bold text-white tracking-wide group-hover:text-cyan-300 transition">
                        {{ $subject->name }}</h2>
                    <p class="mt-3 text-sm text-white/70 leading-relaxed line-clamp-3">
                        {{ $subject->description }}
                    </p>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ route('teacher.subjects.tasks.index', $subject) }}"
                            class="px-4 py-1 text-sm font-semibold rounded-full bg-cyan-800/30 text-cyan-200 hover:bg-cyan-700/50 hover:text-white transition">
                            View Tasks
                        </a>

                        <a href="{{ route('teacher.subjects.edit', $subject) }}"
                            class="px-4 py-1 text-sm font-semibold rounded-full bg-yellow-700/30 text-yellow-300 hover:bg-yellow-600/50 hover:text-white transition">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('teacher.subjects.destroy', $subject) }}"
                            onsubmit="return confirm('Are you sure you want to delete this subject?');"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-1 text-sm font-semibold rounded-full bg-red-700/30 text-red-300 hover:bg-red-600/50 hover:text-white transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-white/60 py-12">
                    No subjects found. Click “Create New Subject” to get started.
                </div>
                @endforelse

            </div>
        </div>
    </div>

    <style>
    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 0.1
        }

        50% {
            opacity: 0.2
        }
    }

    .animate-pulse-slow {
        animation: pulse-slow 8s ease-in-out infinite;
    }

    @keyframes pulse-slow-reverse {

        0%,
        100% {
            opacity: 0.1
        }

        50% {
            opacity: 0.2
        }
    }

    .animate-pulse-slow-reverse {
        animation: pulse-slow-reverse 10s ease-in-out infinite;
    }
    </style>
</x-app-layout>
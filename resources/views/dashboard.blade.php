<x-app-layout>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute -top-24 -left-24 w-96 h-96 bg-gradient-to-br from-purple-600 via-pink-500 to-yellow-400 rounded-full opacity-20 animate-pulse-slow">
        </div>
        <div
            class="absolute -bottom-32 -right-32 w-80 h-80 bg-gradient-to-tl from-indigo-700 via-blue-500 to-teal-400 rounded-full opacity-15 animate-pulse-slow-reverse">
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-extrabold text-4xl text-white tracking-tight">
            Welcome {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 space-y-12 z-10">
        @if(isset($subjects) && $subjects->count())
        <section class="space-y-6" x-data x-intersect.once="revealed = true" x-init="revealed=false">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <h1
                    class="col-span-full text-4xl font-extrabold bg-gradient-to-r from-pink-400 via-indigo-400 to-teal-300 bg-clip-text text-transparent drop-shadow-lg tracking-tight mb-8 pb-2 border-b-4 border-indigo-400 w-fit">
                    My Subjects
                </h1>

                @foreach($subjects as $subject)
                @php
                $gradients = [
                'from-pink-500 via-red-500 to-yellow-500',
                'from-indigo-500 via-purple-500 to-pink-500',
                'from-green-400 via-blue-500 to-purple-600',
                'from-yellow-400 via-red-500 to-pink-500',
                'from-teal-400 via-cyan-500 to-blue-500'
                ];
                $gradient = $gradients[$loop->index % count($gradients)];
                @endphp
                <a href="{{ route(auth()->user()->role . '.subjects.show', $subject->id) }}"
                    class="group relative rounded-3xl overflow-hidden shadow-2xl transition duration-300 bg-gradient-to-br {{ $gradient }} p-6"
                    x-data x-intersect.once="cardIn = true"
                    x-bind:class="{'opacity-100 translate-y-0': cardIn, 'opacity-0 translate-y-8': !cardIn}"
                    x-transition.duration.500ms.delay={{ $loop->index * 100 }}>

                    <div
                        class="absolute -top-4 left-6 bg-white/20 px-4 py-1 rounded-b-lg backdrop-blur-sm text-xs uppercase tracking-wider text-white">
                        {{ strtoupper($subject->code) }}
                    </div>

                    <div class="relative z-10 flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-white group-hover:underline">{{ $subject->name }}</h3>
                            <p class="text-sm text-white/80 mt-1 capitalize">{{ $subject->description }}</p>

                        </div>
                        <i class="fas fa-chevron-right text-white opacity-50 group-hover:opacity-80 transition"></i>
                    </div>

                    <div
                        class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:blur-3xl transition-all duration-300">
                    </div>
                </a>
                @endforeach


            </div>
        </section>
        @endif
        @if(auth()->user()->role === 'teacher')
        <div class="flex justify-center">
            <a href="{{ route('teacher.subjects.create') }}"
                class="group relative inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-full text-white font-semibold text-lg shadow-xl overflow-hidden transition-all duration-300">
                <span class="relative z-10">Add New Subject</span>
                <svg class="absolute w-8 h-8 text-white opacity-20 group-hover:opacity-40 transform group-hover:scale-125 transition-all duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>
        @endif

    </div>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('intersect', () => ({
            revealed: false,
            init() {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(e => {
                        if (e.isIntersecting) {
                            this.revealed = true;
                            observer.unobserve(e.target);
                        }
                    });
                }, {
                    threshold: 0.3
                });
                observer.observe(this.$el);
            }
        }));
    });
    </script>

    <style>
    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 0.2
        }

        50% {
            opacity: 0.3
        }
    }

    .animate-pulse-slow {
        animation: pulse-slow 8s ease-in-out infinite;
    }

    @keyframes pulse-slow-reverse {

        0%,
        100% {
            opacity: 0.15
        }

        50% {
            opacity: 0.25
        }
    }

    .animate-pulse-slow-reverse {
        animation: pulse-slow-reverse 10s ease-in-out infinite;
    }
    </style>
</x-app-layout>
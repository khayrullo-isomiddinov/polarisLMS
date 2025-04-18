<x-app-layout>
  <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-gradient-to-br from-purple-600 via-pink-500 to-yellow-400 rounded-full opacity-20 animate-pulse-slow blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-gradient-to-tl from-indigo-700 via-blue-500 to-teal-400 rounded-full opacity-15 animate-pulse-slow-reverse blur-2xl"></div>
  </div>

  <x-slot name="header">
    <h2 class="font-extrabold text-3xl sm:text-4xl text-white tracking-tight drop-shadow-md">
      Available Subjects
    </h2>
  </x-slot>

  <div class="relative max-w-4xl mx-auto sm:px-6 lg:px-8 py-10 space-y-6 z-10">
    @if (session('success'))
      <div class="p-4 bg-green-100/90 text-green-900 rounded-lg shadow-inner border border-green-300">
        {{ session('success') }}
      </div>
    @endif
    
      @foreach ($subjects as $subject)
        <div class="flex flex-col bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl hover:shadow-2xl transition-shadow duration-300 ease-in-out h-full">
          <div class="flex justify-between items-start">
            <h3 class="text-xl font-semibold text-white truncate">
              {{ $subject->name }}
            </h3>
            <span class="text-sm text-white/60 font-mono tracking-wide uppercase">
              {{ strtoupper($subject->code) }}
            </span>
          </div>

          <p class="text-white/70 text-sm mt-2 line-clamp-3">
            {{ $subject->description }}
          </p>

          <div class="mt-auto pt-4 flex flex-wrap items-center gap-3">
            @if (in_array($subject->id, $enrolled))
              <form method="POST" action="{{ route('student.subjects.leave', $subject) }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-400/50 text-white text-sm rounded-lg shadow transition duration-200">
                  Leave Subject
                </button>
              </form>
            @else
              <form method="POST" action="{{ route('student.subjects.join', $subject) }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-400/50 text-white text-sm rounded-lg shadow transition duration-200">
                  Take Subject
                </button>
              </form>
            @endif

            <a href="{{ route('student.subjects.show', $subject) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-400/50 text-white text-sm rounded-lg shadow transition duration-200">
              View Tasks →
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <style>
    @keyframes pulse-slow {
      0%, 100% { opacity: 0.1; transform: scale(1); }
      50% { opacity: 0.25; transform: scale(1.05); }
    }

    .animate-pulse-slow {
      animation: pulse-slow 8s ease-in-out infinite;
    }

    @keyframes pulse-slow-reverse {
      0%, 100% { opacity: 0.1; transform: scale(1); }
      50% { opacity: 0.2; transform: scale(1.03); }
    }

    .animate-pulse-slow-reverse {
      animation: pulse-slow-reverse 10s ease-in-out infinite;
    }
  </style>
</x-app-layout>

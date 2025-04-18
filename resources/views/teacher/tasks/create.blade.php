<x-app-layout>
    <div class="max-w-2xl mx-auto py-12">
        <h2 class="text-3xl font-extrabold text-white mb-8">Add Task to {{ $subject->name }}</h2>

        <form method="POST" action="{{ route('teacher.subjects.tasks.store', $subject) }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-white font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full bg-gray-800 text-white border border-gray-600 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" />
                @error('title')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-white font-semibold mb-1">Description</label>
                <textarea name="description" required
                    class="w-full bg-gray-800 text-white border border-gray-600 rounded-xl px-4 py-2 h-32 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-white font-semibold mb-1">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline') }}" required
                    class="w-full bg-gray-800 text-white border border-gray-600 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" />
                @error('deadline')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-white font-semibold mb-1">Points</label>
                <input type="number" name="points" min="1" value="{{ old('points') }}" required
                    class="w-full bg-gray-800 text-white border border-gray-600 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" />
                @error('points')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
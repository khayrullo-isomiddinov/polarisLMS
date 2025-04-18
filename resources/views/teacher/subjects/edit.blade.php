<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white tracking-tight">Edit Subject</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-6 space-y-6">
        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-900 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('teacher.subjects.update', $subject) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-white mb-1">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $subject->name) }}"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:outline-none focus:ring focus:ring-indigo-500"
                    required>
                @error('name')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="code" class="block text-sm font-medium text-white mb-1">Code</label>
                <input id="code" name="code" type="text" value="{{ old('code', $subject->code) }}"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:outline-none focus:ring focus:ring-indigo-500"
                    required>
                @error('code')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="credits" class="block text-sm font-medium text-white mb-1">Credits</label>
                <input id="credits" name="credits" type="number" value="{{ old('credits', $subject->credits) }}"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:outline-none focus:ring focus:ring-indigo-500"
                    required>
                @error('credits')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:outline-none focus:ring focus:ring-indigo-500">{{ old('description', $subject->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('teacher.subjects.index') }}"
                   class="text-sm text-white/60 hover:text-white transition">← Back to subjects</a>

                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

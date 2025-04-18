<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 space-y-8">
        <h2 class="text-2xl font-bold text-white">Evaluate Solution</h2>

        <div class="bg-white/10 p-6 rounded-xl shadow border border-white/20 text-white space-y-4">
            <div>
                <strong>Task:</strong> {{ $solution->task->title }}
            </div>

            <div>
                <strong>Description:</strong> {{ $solution->task->description }}
            </div>

            <div class="border-t border-white/10 pt-4">
                <strong>Submitted by:</strong> {{ $solution->user->name }} ({{ $solution->user->email }})
            </div>

            <div>
                <strong>Submission Content:</strong>
                <p class="mt-2 bg-white/5 p-4 rounded-lg">{{ $solution->content }}</p>
            </div>
            <form method="POST" action="{{ route('teacher.solutions.update', $solution) }}">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 text-white/80">Points (0–{{ $solution->task->points }})</label>
                    <input type="number" name="points" min="0" max="{{ $solution->task->points }}"
                           value="{{ old('points', $solution->points) }}"
                           class="w-full px-4 py-2 rounded bg-white/10 text-white border border-white/20 focus:ring focus:ring-indigo-500"
                           required>
                    @error('points')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 text-white rounded shadow">
                        Save Evaluation
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

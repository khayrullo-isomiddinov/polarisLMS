<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Grade Submission</h2>

    <form method="POST" action="{{ route('teacher.solutions.update', $solution) }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label class="block font-semibold mb-1">Submitted Content:</label>
            <div class="bg-gray-100 p-3 rounded">{{ $solution->content }}</div>
        </div>

        <div>
            <label class="block mb-1 font-semibold" for="grade">Grade</label>
            <input type="text" id="grade" name="grade" value="{{ old('grade', $solution->grade) }}"
                class="w-full p-2 border rounded" placeholder="A+, 90, Pass..." />
        </div>

        <div>
            <label class="block mb-1 font-semibold" for="feedback">Feedback</label>
            <textarea id="feedback" name="feedback" rows="4"
                class="w-full p-2 border rounded">{{ old('feedback', $solution->feedback) }}</textarea>
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Save Evaluation</button>
    </form>
</x-app-layout>

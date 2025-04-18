<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Submit Solution for "{{ $task->title }}"</h2>

    <form method="POST" action="{{ route('student.tasks.submit.store', $task) }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Your Answer</label>
            <textarea name="content" rows="6" class="w-full border rounded p-2" required></textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Submit Solution
        </button>
    </form>
</x-app-layout>

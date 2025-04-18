<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h2 class="text-3xl font-extrabold text-white mb-8 tracking-tight">Create New Subject</h2>

        <form method="POST" action="{{ route('teacher.subjects.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-white mb-1">Subject Name <span class="text-red-400">*</span></label>
                <input type="text" id="name" name="name" minlength="3" required
                       class="w-full px-4 py-2 bg-white/5 border border-white/10 text-white placeholder-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                       placeholder="e.g. Algorithms">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2 bg-white/5 border border-white/10 text-white placeholder-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                          placeholder="Add a short description (optional)"></textarea>
            </div>

            <div>
                <label for="code" class="block text-sm font-medium text-white mb-1">Subject Code <span class="text-red-400">*</span></label>
                <input type="text" id="code" name="code" required pattern="IK-[A-Z]{3}[0-9]{3}"
                       class="w-full px-4 py-2 bg-white/5 border border-white/10 text-white placeholder-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                       placeholder="e.g. IK-MAT101"
                       title="Format: IK-SSSNNN (S = uppercase letter, N = number)">
            </div>

            <div>
                <label for="credits" class="block text-sm font-medium text-white mb-1">Credit Value <span class="text-red-400">*</span></label>
                <input type="number" id="credits" name="credits" required min="1"
                       class="w-full px-4 py-2 bg-white/5 border border-white/10 text-white placeholder-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                       placeholder="e.g. 4">
            </div>

            <div>
                <button type="submit"
                        class="px-5 py-2.5 bg-green-600 hover:bg-green-700 rounded-lg text-sm font-semibold text-white tracking-tight shadow transition-all">
                    Create Subject
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

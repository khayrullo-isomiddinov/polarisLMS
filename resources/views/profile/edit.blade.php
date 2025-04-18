<x-app-layout>
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-gradient-to-br from-purple-600 via-pink-500 to-yellow-400 rounded-full opacity-20 animate-pulse-slow"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-gradient-to-tl from-indigo-700 via-blue-500 to-teal-400 rounded-full opacity-15 animate-pulse-slow-reverse"></div>
  </div>

  <div class="min-h-screen relative flex items-center justify-center p-6 overflow-hidden">
    <div class="profile-card z-10 max-w-3xl w-full bg-purple-800/20 backdrop-blur-md rounded-3xl shadow-2xl p-10 space-y-14 border border-purple-700/30 transition-transform duration-200">
      <header class="text-center">
        <h1 class="text-5xl font-extrabold text-white">Edit Profile</h1>
      </header>

      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-10" novalidate>
        @csrf @method('PATCH')

        <div class="flex flex-col md:flex-row items-center gap-6">
          <div class="relative group">
            <div class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden ring-4 ring-purple-600/30 shadow-lg transform transition group-hover:scale-105">
              <img id="photoPreview" src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : 'https://via.placeholder.com/128' }}" alt="Profile Photo" class="w-full h-full object-cover"/>
            </div>
            <label for="profile_photo" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-full transition cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-0 group-hover:opacity-100 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M10 14l2-2m0 0l2 2m-2-2v6"/>
              </svg>
            </label>
            <input id="profile_photo" name="profile_photo" type="file" class="hidden" onchange="previewPhoto(event)" accept="image/*"/>
          </div>
          <div class="flex-1 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-bold text-white">{{ $user->name }}</h2>
            <p class="mt-1 text-base text-white/60">{{ $user->email }}</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="relative">
            <input type="text" name="name" id="name" value="{{ old('name',$user->name) }}" required placeholder="Full Name" autocomplete="name"
                   class="peer w-full bg-transparent border-b-2 border-purple-600/50 text-xl text-white placeholder-transparent focus:border-purple-300 focus:outline-none transition"/>
            <label for="name" class="absolute left-0 -top-5 text-sm text-white/70 transition peer-focus:-top-7 peer-focus:text-purple-300">Full Name</label>
            @error('name')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
          </div>
          <div class="relative">
            <input type="email" name="email" id="email" value="{{ old('email',$user->email) }}" required placeholder="Email Address" autocomplete="email"
                   class="peer w-full bg-transparent border-b-2 border-purple-600/50 text-xl text-white placeholder-transparent focus:border-purple-300 focus:outline-none transition"/>
            <label for="email" class="absolute left-0 -top-5 text-sm text-white/70 transition peer-focus:-top-7 peer-focus:text-purple-300">Email Address</label>
            @error('email')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
          </div>
        </div>

        <div class="text-center">
          <button type="submit"
                  class="relative inline-flex items-center px-12 py-3 rounded-full text-2xl font-semibold text-white shadow-xl bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-700 hover:shadow-2xl transform hover:-translate-y-1 transition group">
            <span class="relative z-10 transition-opacity duration-200 group-hover:opacity-0">Save Changes</span>
            <svg class="absolute w-6 h-6 opacity-0 group-hover:opacity-100 animate-bounce text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
          </button>
        </div>
      </form>

      <div class="pt-6 border-t border-purple-600/30 text-center space-y-4">
        <h3 class="text-2xl font-semibold text-red-400">Delete Account</h3>
        <p class="text-white/60">This action is permanent.</p>
        <button id="deleteBtn" class="inline-flex items-center px-8 py-2 rounded-full border-2 border-red-500 text-red-400 hover:bg-red-600 hover:text-white transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8V8a1 1 0 112 0v2a1 1 0 11-2 0zm1 4a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" clip-rule="evenodd"/></svg>
          Delete My Account
        </button>
      </div>
    </div>
  </div>

  <script>
    function previewPhoto(e) { const reader=new FileReader(); reader.onload=()=>document.getElementById('photoPreview').src=reader.result; reader.readAsDataURL(e.target.files[0]); }
    const card=document.querySelector('.profile-card');
  </script>

  <style>
    @keyframes pulse-slow { 0%,100% { opacity:0.2; } 50% { opacity:0.3; } }
    .animate-pulse-slow { animation: pulse-slow 8s ease-in-out infinite; }
    @keyframes pulse-slow-reverse { 0%,100% { opacity:0.15; } 50% { opacity:0.25; } }
    .animate-pulse-slow-reverse { animation: pulse-slow-reverse 10s ease-in-out infinite; }
  </style>
</x-app-layout>
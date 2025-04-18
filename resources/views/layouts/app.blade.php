<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <title>{{ config('app.name', 'Polaris') }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      color: #f5f5f5;
      background: radial-gradient(50% 100% at 50% 0%, #2c2c2c 0%, #1c1c1c 80%);
      background-size: cover;
      background-attachment: fixed;
    }
    #sidebar {
      width: 260px;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      transition: transform 0.5s ease;
      z-index: 15;
    }
    .sidebar-hidden {
      transform: translateX(-260px);
    }
    #mainContent {
      transition: margin-left 0.5s ease, transform 0.5s ease;
      margin-left: 260px;
      transform: scale(1);
    }
    .main-expanded {
      margin-left: 0;
      transform: scale(1.05);
    }
    .glow-toggle {
      cursor: pointer;
      color: #c8a35f;
      transition: transform 0.4s ease, color 0.4s ease;
    }
    .glow-toggle:hover {
      transform: rotate(20deg) scale(1.2);
      color: #ffd700;
      text-shadow: 0 0 10px #ffd700;
    }
  </style>
</head>
<body class="antialiased min-h-screen relative">
  <aside id="sidebar" class="bg-white/5 backdrop-blur-md px-6 py-8 border-r border-white/10">
    <div class="relative">
      <div class="flex items-center justify-between text-xl font-bold text-white mb-10">
        <span>Polaris Panel</span>
        <i class="fas fa-star text-2xl glow-toggle" onclick="toggleSidebar()"></i>
      </div>
      @auth
      <div class="flex items-center gap-4 mb-10 text-white">
        @if (auth()->user()->profile_photo_path)
        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-white/20">
        @else
        <div class="w-12 h-12 rounded-full bg-gray-400 flex items-center justify-center">
          <i class="fas fa-user text-white"></i>
        </div>
        @endif
        <div>
          <p class="font-semibold">{{ auth()->user()->name }}</p>
          <p class="text-sm text-gray-300 capitalize">{{ auth()->user()->role }}</p>
        </div>
      </div>
      @endauth
      <nav class="space-y-2 text-sm">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-white/10 text-white {{ request()->routeIs('dashboard') ? 'bg-white/10 font-semibold' : '' }}">
          <i class="fas fa-home mr-2"></i> Menu
        </a>
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-white/10 text-white {{ request()->routeIs('profile.edit') ? 'bg-white/10 font-semibold' : '' }}">
          <i class="fas fa-user mr-2"></i> Profile
        </a>
        @auth
          @php $role = auth()->user()->role; @endphp
          @if ($role === 'teacher')
          <a href="{{ route('teacher.subjects.index') }}" class="block px-4 py-2 rounded hover:bg-white/10 text-white {{ request()->routeIs('teacher.subjects.*') ? 'bg-white/10 font-semibold' : '' }}">
            <i class="fas fa-book mr-2"></i> Subjects
          </a>
          @elseif ($role === 'student')
          <a href="{{ route('student.subjects.index') }}" class="block px-4 py-2 rounded hover:bg-white/10 text-white {{ request()->routeIs('student.subjects.*') ? 'bg-white/10 font-semibold' : '' }}">
            <i class="fas fa-book-open mr-2"></i> Subjects
          </a>
          @endif
        @endauth
      </nav>
    </div>
    @auth
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="w-full text-left px-4 py-2 rounded text-red-400 hover:bg-red-500/10">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </form>
    @endauth
  </aside>

  <div id="mainContent" class="min-h-screen">
    <div class="p-10 space-y-6">
      @auth
      <div class="flex items-center justify-between bg-white/5 backdrop-blur-md p-6 rounded-xl shadow border border-white/10">
        <div class="flex items-center gap-4">
          @if (auth()->user()->profile_photo_path)
          <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-16 h-16 rounded-full object-cover shadow-md ring-2 ring-white/20">
          @else
          <div class="w-16 h-16 rounded-full bg-gray-400 flex items-center justify-center">
            <i class="fas fa-user text-white text-xl"></i>
          </div>
          @endif
          <div>
            <h1 class="text-2xl font-bold text-white">Hello {{ auth()->user()->name }}!</h1>
            <p class="text-sm text-gray-300 capitalize">{{ auth()->user()->role }}</p>
          </div>
        </div>
        <div>
          <i class="fas fa-cog text-gray-300 hover:text-gray-100 cursor-pointer"></i>
        </div>
      </div>
      @endauth
      <div class="bg-white/5 backdrop-blur-md p-6 rounded-xl shadow border border-white/10 text-white">
        {{ $slot }}
      </div>
    </div>
  </div>

  <script>
  let sidebarVisible = true;
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const restoreButton = document.getElementById('restoreSidebarBtn');
    sidebarVisible = !sidebarVisible;
    if (sidebarVisible) {
      sidebar.classList.remove('sidebar-hidden');
      mainContent.classList.remove('main-expanded');
      mainContent.style.marginLeft = '260px';
      restoreButton.classList.add('hidden');
    } else {
      sidebar.classList.add('sidebar-hidden');
      mainContent.classList.add('main-expanded');
      mainContent.style.marginLeft = '0';
      restoreButton.classList.remove('hidden');
    }
  }
</script>


<button id="restoreSidebarBtn" onclick="toggleSidebar()" 
        class="hidden fixed top-1/2 -translate-y-1/2 -left-5 z-30 bg-white/10 text-white p-2 pl-3 rounded-r-full border border-white/10 backdrop-blur hover:bg-white/20 transition duration-300">
  <i class="fas fa-star text-sm"></i>
</button>

</button>
</body>
</html>

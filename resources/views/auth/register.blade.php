<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Polaris - Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      color: #f5f5f5;
      background: radial-gradient(50% 100% at 50% 0%, #2c2c2c 0%, #1c1c1c 80%);
      background-size: cover;
      background-attachment: fixed;
    }

    .nav-glass {
      background: rgba(255, 255, 255, 0.07);
      backdrop-filter: blur(8px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .accent {
      color: #c8a35f;
    }
    .bg-accent {
      background-color: #c8a35f;
    }

    .btn-hover:hover {
      transform: scale(1.05) translateY(-2px);
      box-shadow: 0 8px 20px rgba(200, 163, 95, 0.4);
    }
    .hero-heading {
      position: relative;
      overflow: hidden;
    }
    .hero-heading::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
      animation: scan 3s infinite;
    }
    @keyframes scan {
      0% { left: -100%; }
      50% { left: 100%; }
      100% { left: 100%; }
    }
  </style>
</head>
<body>
  <nav class="nav-glass sticky top-0 z-50 py-4">
    <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
      <div class="text-2xl md:text-3xl font-bold tracking-wide">
        <span class="accent">Polaris</span>LMS
      </div>
      <div class="space-x-6 text-lg">
        <a href="{{ url('/') }}" class="hover:text-accent transition">Main</a>
        <a href="{{ url('/') }}#contact" class="hover:text-accent transition">Contact</a>
        <a href="{{ route('login') }}" class="hover:text-accent transition">Login</a>
        <a href="{{ route('register') }}" class="hover:text-accent transition accent">Register</a>
      </div>
    </div>
  </nav>

  <div class="min-h-screen flex flex-col items-center justify-center px-6 text-center">
    <h1 class="hero-heading text-4xl md:text-6xl font-extrabold mb-8 mt-10">
      Register for <span class="accent">Polaris</span>
    </h1>

    <div class="w-full max-w-md bg-white text-gray-900 rounded-lg p-8 shadow-lg">
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
          <label for="name" class="block font-semibold mb-1">Name</label>
          <input id="name"
                 class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent"
                 type="text"
                 name="name"
                 value="{{ old('name') }}"
                 required
                 autofocus
                 autocomplete="name" />
          @error('name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="block font-semibold mb-1">Email</label>
          <input id="email"
                 class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent"
                 type="email"
                 name="email"
                 value="{{ old('email') }}"
                 required
                 autocomplete="username" />
          @error('email')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="block font-semibold mb-1">Password</label>
          <input id="password"
                 class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent"
                 type="password"
                 name="password"
                 required
                 autocomplete="new-password" />
          @error('password')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-6">
          <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
          <input id="password_confirmation"
                 class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent"
                 type="password"
                 name="password_confirmation"
                 required
                 autocomplete="new-password" />
          @error('password_confirmation')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex items-center justify-between">
          <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
          </a>
          
          <button type="submit"
                  class="btn-hover bg-accent text-white font-bold py-2 px-6 rounded-full transition">
            {{ __('Register') }}
          </button>
        </div>
      </form>
    </div>
  </div>

  <footer class="relative bg-black bg-opacity-50 backdrop-blur-md border-t border-gray-600 py-8 mt-10">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
      <p class="text-lg text-gray-300">&copy; <span id="currentYear"></span> Polaris. All rights reserved.</p>
      <div class="flex gap-4 mt-4 md:mt-0 text-2xl text-gray-300">
        <a href="#" class="transition-colors hover:text-accent"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="transition-colors hover:text-accent"><i class="fab fa-twitter"></i></a>
        <a href="#" class="transition-colors hover:text-accent"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="transition-colors hover:text-accent"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>
</body>
</html>

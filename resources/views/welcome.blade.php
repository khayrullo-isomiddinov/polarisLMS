<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Polaris - North Star Learning System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      color: #f5f5f5;
    }

    body {
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

    .fade {
      transition: opacity 0.6s ease-in-out;
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

    .btn-hover:hover {
      transform: scale(1.05) translateY(-2px);
      box-shadow: 0 8px 20px rgba(200, 163, 95, 0.4);
    }

    .footer-icon:hover {
      transform: scale(1.2) rotate(-5deg);
      transition: transform 0.3s ease-in-out;
      color: #c8a35f !important;
    }
    
    .custom-label {
      margin-bottom: 0.4rem;
      line-height: 1.3;
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
        <a href="#" onclick="showSection('main')" class="hover:text-accent transition">Main</a>
        <a href="#" onclick="showSection('contact')" class="hover:text-accent transition">Contact</a>
        <a href="{{ route('login') }}" class="hover:text-accent transition">Login</a>
        <a href="{{ route('register') }}" class="hover:text-accent transition">Register</a>
      </div>
    </div>
  </nav>

  <section id="main" class="max-w-6xl mx-auto px-6 fade">
    <div class="min-h-screen flex flex-col items-center justify-center text-center">
      <h1 class="hero-heading text-4xl md:text-6xl font-extrabold mb-6">
        Welcome to <span class="accent">Polaris</span>
      </h1>
      <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto leading-relaxed text-gray-200">
        Experience the perfect blend of cutting-edge technology and sophisticated design. Step into a space where knowledge meets style—learning has never looked or felt this good.
      </p>
      <div class="flex flex-col sm:flex-row gap-6">
        <a href=" {{ route('login') }}" class="btn-hover px-10 py-4 bg-accent rounded-full text-lg font-bold shadow-xl transition transform">
          Login
        </a>
        <a href="#register" onclick="showSection('register')"
           class="btn-hover px-10 py-4 border border-accent rounded-full text-lg font-bold shadow-xl transition transform">
          Register
        </a>
      </div>
    </div>
  </section>

  <section id="contact" class="max-w-6xl mx-auto px-6 hidden fade">
    <div class="min-h-screen flex flex-col items-center justify-center text-center">
      <h1 class="hero-heading text-4xl md:text-6xl font-extrabold mb-6">Contact</h1>
      
      <p class="text-xl md:text-2xl max-w-2xl mb-10 leading-relaxed text-gray-300">
        I would love to hear from you! Whether you have questions about Polaris, suggestions for new features, or just want to say hello, I am ready to help make your learning experience even better. 
      </p>
      
      <div class="border-t border-gray-500 w-full max-w-2xl mb-6"></div>
      
      <div class="text-xl md:text-2xl space-y-4">
        <p><strong>Author:</strong> Khayrullo Isomiddinov</p>
        <p><strong>Neptun Code:</strong> BET9FI</p>
        <p><strong>Email:</strong> bet9fi@inf.elte.hu</p>
      </div>
      
      <div class="border-t border-gray-500 w-full max-w-2xl mt-6 mb-6"></div>
      
      <div class="text-xl md:text-2xl space-y-4 text-gray-300">
        <p><i class="fas fa-map-marker-alt"></i> 36 Jozsef Korut, Budapest, Hungary</p>
        <p><i class="fas fa-phone"></i> +36 703 430 741</p>
        <p class="max-w-xl mx-auto">
          <i class="fas fa-comment-dots"></i> 
          Have feedback or general inquiries? 
          <a href="mailto:isomiddinovkhayrullo@gmail.com" class="text-accent underline hover:opacity-75">Send me a message</a> 
        </p>
      </div>
    </div>
  </section>

  <section id="login" class="max-w-6xl mx-auto px-6 hidden fade">
    <div class="min-h-screen flex flex-col items-center justify-center">
      <h1 class="hero-heading text-4xl md:text-6xl font-extrabold mb-8">Login</h1>
      <form id="loginForm" onsubmit="handleLogin(event)" class="w-full max-w-md space-y-6">
        <div>
          <label for="loginEmail" class="custom-label block text-lg">Email:</label>
          <input type="email" id="loginEmail" required
                 class="w-full p-3 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-accent" />
        </div>
        <div>
          <label for="loginPassword" class="custom-label block text-lg">Password:</label>
          <input type="password" id="loginPassword" required
                 class="w-full p-3 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-accent" />
        </div>
        <button type="submit"
                class="btn-hover w-full py-3 bg-accent rounded text-xl font-bold shadow-xl transition">
          Login
        </button>
      </form>
    </div>
  </section>

  <section id="register" class="max-w-6xl mx-auto px-6 hidden fade">
    <div class="min-h-screen flex flex-col items-center justify-center">
      <h1 class="hero-heading text-4xl md:text-6xl font-extrabold mb-8">Register</h1>
      <form id="registerForm" onsubmit="handleRegister(event)" class="w-full max-w-md space-y-6">
        <div>
          <label for="regUsername" class="custom-label block text-lg">Username:</label>
          <input type="text" id="regUsername" required
                 class="w-full p-3 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>
        <div>
          <label for="regEmail" class="custom-label block text-lg">Email:</label>
          <input type="email" id="regEmail" required
                 class="w-full p-3 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>
        <div>
          <label for="regPassword" class="custom-label block text-lg">Password:</label>
          <input type="password" id="regPassword" required
                 class="w-full p-3 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>
        <div>
          <label for="regPasswordConfirm" class="custom-label block text-lg">Confirm Password:</label>
          <input type="password" id="regPasswordConfirm" required
                 class="w-full p-3 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>
        <button type="submit"
                class="btn-hover w-full py-3 bg-green-600 rounded text-xl font-bold shadow-xl transition hover:bg-green-700">
          Register
        </button>
      </form>
    </div>
  </section>

  <footer class="relative bg-black bg-opacity-50 backdrop-blur-md border-t border-gray-600 py-8 mt-10">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
      <p class="text-lg">&copy; <span id="currentYear"></span> Polaris. All rights reserved.</p>
      <div class="flex gap-4 mt-4 md:mt-0 text-2xl">
        <a href="https://www.facebook.com/profile.php?id=100080260460705" class="footer-icon transition-colors"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.linkedin.com/in/khayrullo-isomiddinov-690443234/" class="footer-icon transition-colors"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://www.instagram.com/khayrullo_isomiddinov/" class="footer-icon transition-colors"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <script>
    function showSection(sectionId) {
      document.querySelectorAll('section').forEach(section => {
        section.classList.add('hidden');
      });
      const activeSection = document.getElementById(sectionId);
      activeSection.classList.remove('hidden');
      activeSection.style.opacity = 0;
      setTimeout(() => activeSection.style.opacity = 1, 50);
    }
    
    function handleRegister(event) {
      event.preventDefault();
      const username = document.getElementById("regUsername").value;
      const email = document.getElementById("regEmail").value;
      const password = document.getElementById("regPassword").value;
      const passwordConfirm = document.getElementById("regPasswordConfirm").value;
      
      if (password !== passwordConfirm) {
        alert("Passwords do not match!");
        return;
      }
      
      const user = { username, email, password };
      localStorage.setItem("user", JSON.stringify(user));
      
      alert("Registration successful! Please log in.");
      showSection("login");
    }

    function handleLogin(event) {
      event.preventDefault();
      const email = document.getElementById("loginEmail").value;
      const password = document.getElementById("loginPassword").value;
      const storedUser = localStorage.getItem("user");
      
      if (!storedUser) {
        alert("No registered user found. Please register first.");
        return;
      }
      
      const user = JSON.parse(storedUser);
      if (user.email === email && user.password === password) {
        alert("Login successful!");
        showSection("main"); 
      } else {
        alert("Invalid email or password.");
      }
    }
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>
</body>
</html>

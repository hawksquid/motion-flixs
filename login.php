<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MotionFlix | Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --netflix-red: #e50914;
    }

    .bg-netflix {
      background-color: #141414;
    }

    .btn-red {
      background-color: var(--netflix-red);
    }

    .btn-red:hover {
      background-color: #b0060f;
    }

    .form-input {
      background-color: #222;
      border: none;
      color: white;
    }

    .form-input:focus {
      outline: none;
      box-shadow: 0 0 0 2px var(--netflix-red);
      background-color: #222;
    }
  </style>
</head>
<body class="bg-netflix flex items-center justify-center min-h-screen text-white">

  <div class="w-full max-w-sm bg-black/90 p-8 rounded-xl shadow-lg backdrop-blur-md border border-zinc-800">
    <!-- Brand -->
    <div class="text-center mb-6">
      <h1 class="text-4xl font-extrabold text-[--netflix-red] tracking-widest">MotionFlix</h1>
      <p class="text-sm text-gray-400 mt-1">Welcome back. Please login.</p>
    </div>

    <!-- Form -->
    <form id="loginForm" class="space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Email</label>
        <input type="email" id="email" name="email" required
               class="form-input w-full px-4 py-2 rounded-lg focus:ring-0" />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input type="password" id="password" name="password" required
               class="form-input w-full px-4 py-2 rounded-lg focus:ring-0" />
      </div>

      <div class="flex justify-between text-sm text-gray-400">
        <label class="flex items-center">
          <input type="checkbox" class="mr-2 accent-[--netflix-red]"> Remember me
        </label>
        <a href="#" class="hover:underline hover:text-white">Forgot password?</a>
      </div>

      <button type="submit"
              class="btn-red w-full text-white py-2 rounded-lg font-semibold transition duration-200">Login</button>
    </form>

    <p class="text-sm text-center text-gray-400 mt-5">
      Don’t have an account?
      <a href="/register.php" class="text-[--netflix-red] hover:underline">Sign up</a>
    </p>
  </div>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent actual form submission
      window.location.href = "dashboard.php"; // Redirect to dashboard
    });
  </script>

</body>
</html>

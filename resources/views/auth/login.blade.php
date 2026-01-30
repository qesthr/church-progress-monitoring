<!DOCTYPE html>
<html>
<head>
    <title>Church Monitoring - Login/Register</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div style="max-width: 400px; margin: 50px auto;">
        <h2>Login or Register</h2>

        <!-- Toggle Buttons -->
        <div>
            <button onclick="showLogin()">Login</button>
            <button onclick="showRegister()">Register</button>
        </div>

        <!-- Login Form -->
        <form id="login-form" action="{{ route('login') }}" method="POST" style="margin-top:20px;">
            @csrf
            <input type="email" name="email" placeholder="Email" required class="block mb-2 w-full p-2 border">
            <input type="password" name="password" placeholder="Password" required class="block mb-2 w-full p-2 border">
            <button type="submit" class="block w-full bg-blue-500 text-white p-2">Login</button>
        </form>

        <!-- Registration Form -->
        <form id="register-form" action="{{ route('register') }}" method="POST" style="margin-top:20px; display:none;">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required class="block mb-2 w-full p-2 border">
            <input type="email" name="email" placeholder="Email" required class="block mb-2 w-full p-2 border">
            <input type="password" name="password" placeholder="Password" required class="block mb-2 w-full p-2 border">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="block mb-2 w-full p-2 border">
            <button type="submit" class="block w-full bg-green-500 text-white p-2">Register</button>
        </form>
    </div>

    <script>
        function showLogin() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
        }

        function showRegister() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-5">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-8 px-5">
            <h1 class="text-2xl font-bold">Church Progress Management System</h1>
        </div>
        
        <div class="p-8">
            <!-- Login Form -->
            <div class="form-section {{ $errors->any() && !$errors->has('email') ? 'hidden' : '' }}" id="loginForm">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login</h2>
                
                @if($errors->has('email'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-5">
                        <label for="login-email" class="block text-gray-700 font-medium mb-2 text-sm">Email Address</label>
                        <input 
                            type="email" 
                            id="login-email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"
                            required 
                            autofocus
                        >
                    </div>
                    
                    <div class="mb-5">
                        <label for="login-password" class="block text-gray-700 font-medium mb-2 text-sm">Password</label>
                        <input 
                            type="password" 
                            id="login-password" 
                            name="password" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"
                            required
                        >
                    </div>
                    
                    <div class="mb-5 flex items-center gap-2">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember"
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        >
                        <label for="remember" class="text-gray-700 text-sm">Remember Me</label>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all shadow-lg hover:shadow-xl"
                    >
                        Login
                    </button>
                </form>
                
                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-600 text-sm">
                        Don't have an account? 
                        <a 
                            onclick="toggleForms()" 
                            class="text-indigo-600 font-medium hover:text-purple-600 cursor-pointer hover:underline transition-colors"
                        >
                            Register here
                        </a>
                    </p>
                </div>
            </div>
            
            <!-- Register Form -->
            <div class="form-section {{ $errors->any() && !$errors->has('email') ? '' : 'hidden' }}" id="registerForm">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Register</h2>
                
                @if($errors->any() && !$errors->has('email'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="register-name" class="block text-gray-700 font-medium mb-2 text-sm">Full Name</label>
                        <input 
                            type="text" 
                            id="register-name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"
                            required
                        >
                    </div>
                    
                    <div class="mb-4">
                        <label for="register-email" class="block text-gray-700 font-medium mb-2 text-sm">Email Address</label>
                        <input 
                            type="email" 
                            id="register-email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"
                            required
                        >
                    </div>
                    
                    <div class="mb-4">
                        <label for="register-password" class="block text-gray-700 font-medium mb-2 text-sm">Password</label>
                        <input 
                            type="password" 
                            id="register-password" 
                            name="password" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"
                            required
                        >
                    </div>
                    
                    <div class="mb-4">
                        <label for="register-password-confirmation" class="block text-gray-700 font-medium mb-2 text-sm">Confirm Password</label>
                        <input 
                            type="password" 
                            id="register-password-confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors"
                            required
                        >
                    </div>
                    
                    <div class="mb-5">
                        <label for="register-role" class="block text-gray-700 font-medium mb-2 text-sm">Select Your Role</label>
                        <select 
                            id="register-role" 
                            name="role" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition-colors bg-white"
                            required
                        >
                            <option value="">-- Choose Role --</option>
                            <option value="pastor" {{ old('role') == 'pastor' ? 'selected' : '' }}>Pastor</option>
                            <option value="leader" {{ old('role') == 'leader' ? 'selected' : '' }}>Leader</option>
                            <option value="disciple" {{ old('role') == 'disciple' ? 'selected' : '' }}>Disciple</option>
                        </select>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all shadow-lg hover:shadow-xl"
                    >
                        Register
                    </button>
                </form>
                
                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-600 text-sm">
                        Already have an account? 
                        <a 
                            onclick="toggleForms()" 
                            class="text-indigo-600 font-medium hover:text-purple-600 cursor-pointer hover:underline transition-colors"
                        >
                            Login here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            loginForm.classList.toggle('hidden');
            registerForm.classList.toggle('hidden');
        }
    </script>
</body>
</html>
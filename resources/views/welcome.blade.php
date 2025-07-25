<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - File Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
<div class="text-center">
    <h1 class="text-4xl font-bold mb-6">📁 Welcome to File Manager</h1>
    <p class="text-gray-300 mb-8">A simple and secure place to manage your personal files.</p>

    @auth
        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded text-white">Go to Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 px-5 py-2 rounded text-white mr-3">Login</a>
        <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-gray-700 px-5 py-2 rounded text-white">Register</a>
    @endauth
</div>
</body>
</html>

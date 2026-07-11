<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css'])

    <title>Login Admin</title>
</head>

<body class="bg-black flex items-center justify-center min-h-screen px-6">

<form action="{{ route('login.post') }}"
    method="POST"
    autocomplete="off"
    class="bg-[#0B1220] p-10 rounded-3xl w-full max-w-md border border-gray-800">

    @csrf

    <h1 class="text-4xl font-bold text-white mb-8 text-center">
        Login Admin
    </h1>

    <!-- Email -->
    <div class="mb-5">

        <label class="text-gray-300 block mb-2">
            Email
        </label>

        <input type="email"
            name="email"
            autocomplete="off"
            value=""
            class="w-full p-4 rounded-xl bg-black border border-gray-700 text-white focus:outline-none focus:border-cyan-400">

    </div>

    <!-- Password -->
    <div class="mb-8">

        <label class="text-gray-300 block mb-2">
            Password
        </label>

        <input type="password"
            name="password"
            autocomplete="new-password"
            value=""
            class="w-full p-4 rounded-xl bg-black border border-gray-700 text-white focus:outline-none focus:border-cyan-400">

    </div>

    <!-- Button -->
    <button
        class="w-full bg-cyan-400 text-black py-4 rounded-xl font-bold hover:scale-105 duration-300">

        Login

    </button>

<!-- Tombol Kembali -->
<a href="/"
    class="block text-center border border-gray-700 text-gray-300 py-4 rounded-xl hover:border-cyan-400 hover:text-cyan-400 duration-300 mt-4">

    ← Kembali ke Beranda

</a>

    </form>

</body>
</html>
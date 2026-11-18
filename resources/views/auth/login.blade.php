<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Portfolio Dina</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center px-5 py-12">

<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <a href="/" class="text-3xl font-extrabold text-cyan-400">Dina<span class="text-white">.</span></a>
        <p class="text-slate-500 text-sm mt-2">Masuk untuk mengelola portfolio</p>
    </div>

    <form action="{{ route('login.post') }}" method="POST" autocomplete="off"
        class="bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-2xl">

        @csrf

        <h1 class="text-2xl font-extrabold mb-7 text-center">Login Admin</h1>

        @if(session('error'))
            <div class="mb-5 p-4 rounded-xl bg-red-500/10 border border-red-500/40 text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-500/10 border border-red-500/40 text-red-400 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-5">
            <label for="email" class="block text-sm font-semibold mb-2 text-slate-300">Email</label>
            <input id="email" type="email" name="email" autocomplete="off" value="{{ old('email') }}"
                class="w-full px-4 py-3.5 rounded-xl bg-slate-950 border border-slate-700 focus:border-cyan-400 outline-none text-sm">
        </div>

        <div class="mb-7">
            <label for="password" class="block text-sm font-semibold mb-2 text-slate-300">Password</label>
            <input id="password" type="password" name="password" autocomplete="new-password"
                class="w-full px-4 py-3.5 rounded-xl bg-slate-950 border border-slate-700 focus:border-cyan-400 outline-none text-sm">
        </div>

        <button type="submit" class="w-full py-3.5 rounded-xl bg-cyan-400 text-slate-950 font-bold hover:bg-cyan-300 transition">
            Masuk
        </button>

        <a href="/" class="block text-center mt-4 py-3 rounded-xl border border-slate-700 text-sm font-semibold text-slate-400 hover:border-cyan-400 hover:text-cyan-400 transition">
            ← Kembali ke Beranda
        </a>
    </form>
</div>

</body>
</html>

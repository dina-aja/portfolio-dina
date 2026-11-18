<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Portfolio Dina</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen">

@php
    $unread = \App\Models\Message::where('is_read', false)->count();
    $menus = [
        ['label' => 'Dashboard', 'route' => route('dashboard'), 'icon' => '📊', 'active' => request()->routeIs('dashboard')],
        ['label' => 'Profil & Konten', 'route' => route('settings.edit'), 'icon' => '⚙️', 'active' => request()->routeIs('settings.*')],
        ['label' => 'Proyek', 'route' => route('admin.index', ['resource' => 'projects']), 'icon' => '💼', 'active' => request()->routeIs('admin.*') && request()->route('resource') === 'projects'],
        ['label' => 'Sertifikat', 'route' => route('admin.index', ['resource' => 'certificates']), 'icon' => '🏆', 'active' => request()->routeIs('admin.*') && request()->route('resource') === 'certificates'],
        ['label' => 'Pengalaman', 'route' => route('admin.index', ['resource' => 'experiences']), 'icon' => '🧭', 'active' => request()->routeIs('admin.*') && request()->route('resource') === 'experiences'],
        ['label' => 'Keahlian', 'route' => route('admin.index', ['resource' => 'skills']), 'icon' => '🛠️', 'active' => request()->routeIs('admin.*') && request()->route('resource') === 'skills'],
        ['label' => 'Testimoni', 'route' => route('admin.index', ['resource' => 'testimonials']), 'icon' => '💬', 'active' => request()->routeIs('admin.*') && request()->route('resource') === 'testimonials'],
        ['label' => 'Blog', 'route' => route('admin.index', ['resource' => 'blog-posts']), 'icon' => '📝', 'active' => request()->routeIs('admin.*') && request()->route('resource') === 'blog-posts'],
        ['label' => 'Pesan Masuk', 'route' => route('messages.index'), 'icon' => '✉️', 'active' => request()->routeIs('messages.*'), 'badge' => $unread],
    ];
@endphp

<div class="min-h-screen lg:pl-64">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
        <div class="px-6 py-6 border-b border-slate-800">
            <a href="{{ route('home') }}" class="text-2xl font-extrabold text-cyan-400">Dina<span class="text-white">.</span></a>
            <p class="text-xs text-slate-500 mt-1">Dashboard Admin</p>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1">
            @foreach($menus as $menu)
                <a href="{{ $menu['route'] }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ $menu['active'] ? 'bg-cyan-400/10 text-cyan-400' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-lg">{{ $menu['icon'] }}</span>
                    <span class="flex-1">{{ $menu['label'] }}</span>
                    @if(!empty($menu['badge']))
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-red-500 text-white">{{ $menu['badge'] }}</span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-slate-800 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="block text-center px-4 py-2.5 rounded-xl border border-slate-700 text-sm font-semibold hover:border-cyan-400 hover:text-cyan-400 transition">
                Lihat Website ↗
            </a>
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin keluar?')">
                @csrf
                <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-red-500/10 border border-red-500/40 text-red-400 text-sm font-semibold hover:bg-red-500 hover:text-white transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    @if(session('success'))
        <div class="fixed top-5 right-5 z-[60] max-w-sm px-6 py-4 rounded-xl bg-cyan-400 text-slate-950 font-bold shadow-2xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="lg:hidden flex items-center justify-between p-4 bg-slate-900 border-b border-slate-800">
        <span class="font-bold text-cyan-400">Admin Panel</span>
        <button id="sidebar-toggle" type="button" class="px-3 py-2 rounded-lg border border-slate-700 text-sm">☰ Menu</button>
    </div>

    <main class="p-5 sm:p-8">
        @yield('content')
    </main>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    document.getElementById('sidebar-toggle').addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
@stack('scripts')
</body>
</html>

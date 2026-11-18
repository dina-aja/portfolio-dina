<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Portfolio Dina</title>

    <script>
        // Sama seperti halaman pengguna: pakai localStorage agar tema tidak berkedip.
        if (!localStorage.getItem('theme')) localStorage.setItem('theme', 'dark');
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen">

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
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
        <div class="px-6 py-6 border-b border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-cyan-600 dark:text-cyan-400">Dina<span class="text-slate-900 dark:text-white">.</span></a>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Dashboard Admin</p>
                </div>
                <button type="button" class="admin-theme-toggle w-9 h-9 rounded-xl border border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-cyan-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition" aria-label="Ganti tema">
                    <svg class="admin-theme-icon-sun w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/><path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                    </svg>
                    <svg class="admin-theme-icon-moon w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                </button>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1">
            @foreach($menus as $menu)
                <a href="{{ $menu['route'] }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ $menu['active'] ? 'bg-cyan-50 dark:bg-cyan-400/10 text-cyan-600 dark:text-cyan-400' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                    <span class="text-lg">{{ $menu['icon'] }}</span>
                    <span class="flex-1">{{ $menu['label'] }}</span>
                    @if(!empty($menu['badge']))
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-red-500 text-slate-900 dark:text-white">{{ $menu['badge'] }}</span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-slate-200 dark:border-slate-800 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="block text-center px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 text-sm font-semibold hover:border-cyan-400 hover:text-cyan-600 dark:text-cyan-400 transition">
                Lihat Website ↗
            </a>
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin keluar?')">
                @csrf
                <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-300 dark:border-red-500/40 text-red-600 dark:text-red-400 text-sm font-semibold hover:bg-red-500 hover:text-slate-900 dark:hover:text-white transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    @if(session('success'))
        <div class="fixed top-5 right-5 z-[60] max-w-sm px-6 py-4 rounded-xl bg-cyan-500 text-slate-950 font-bold shadow-2xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="lg:hidden flex items-center justify-between p-4 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
        <span class="font-bold text-cyan-600 dark:text-cyan-400">Admin Panel</span>
        <div class="flex items-center gap-2">
            <button type="button" class="admin-theme-toggle w-9 h-9 rounded-lg border border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-cyan-400" aria-label="Ganti tema">
                <svg class="admin-theme-icon-sun w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="4"/><path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                </svg>
                <svg class="admin-theme-icon-moon w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>
            <button id="sidebar-toggle" type="button" class="px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm">☰ Menu</button>
        </div>
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

    // Tombol dark/light, memakai localStorage yang sama dengan halaman pengguna.
    function syncAdminThemeIcons() {
        const isDark = document.documentElement.classList.contains('dark');
        document.querySelectorAll('.admin-theme-icon-sun').forEach((el) => el.classList.toggle('hidden', isDark));
        document.querySelectorAll('.admin-theme-icon-moon').forEach((el) => el.classList.toggle('hidden', !isDark));
    }
    syncAdminThemeIcons();
    document.querySelectorAll('.admin-theme-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            syncAdminThemeIcons();
        });
    });
</script>
@stack('scripts')
</body>
</html>

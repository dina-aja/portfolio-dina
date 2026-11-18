@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
@php
    $counts = [
        'projects' => \App\Models\Project::count(),
        'certificates' => \App\Models\Certificate::count(),
        'experiences' => \App\Models\Experience::count(),
        'skills' => \App\Models\Skill::count(),
        'testimonials' => \App\Models\Testimonial::count(),
        'blog-posts' => \App\Models\BlogPost::count(),
    ];
    $recentMessages = \App\Models\Message::latest()->take(4)->get();
@endphp

<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <p class="text-cyan-400 text-sm font-bold uppercase tracking-widest mb-2">Halo, {{ Auth::user()->name }}</p>
        <h1 class="text-3xl font-extrabold">Dashboard Admin</h1>
        <p class="text-slate-400 text-sm mt-2">Kelola seluruh konten portfolio dari satu tempat. Perubahan langsung tampil di website.</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800">
            <p class="text-3xl font-extrabold text-cyan-400">{{ $counts['projects'] }}</p>
            <p class="text-sm text-slate-400 mt-1">Proyek</p>
        </div>
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800">
            <p class="text-3xl font-extrabold text-cyan-400">{{ $counts['certificates'] }}</p>
            <p class="text-sm text-slate-400 mt-1">Sertifikat</p>
        </div>
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800">
            <p class="text-3xl font-extrabold text-cyan-400">{{ $counts['skills'] }}</p>
            <p class="text-sm text-slate-400 mt-1">Keahlian</p>
        </div>
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800">
            <p class="text-3xl font-extrabold text-cyan-400">{{ $messageCount }}</p>
            <p class="text-sm text-slate-400 mt-1">Pesan Belum Dibaca</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Kelola konten -->
        <div class="lg:col-span-2 p-6 rounded-2xl bg-slate-900 border border-slate-800">
            <h2 class="text-xl font-bold mb-5">Kelola Konten</h2>
            <div class="grid sm:grid-cols-2 gap-3">
                @foreach($sections as $key => $section)
                    <a href="{{ route('admin.index', ['resource' => $key]) }}"
                        class="flex items-center justify-between p-4 rounded-xl bg-slate-950 border border-slate-800 hover:border-cyan-400 transition">
                        <div>
                            <p class="font-bold text-sm">{{ $section['title'] }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $counts[$key] ?? 0 }} data</p>
                        </div>
                        <span class="text-cyan-400">→</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Aksi cepat -->
        <div class="space-y-6">
            <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800">
                <h2 class="text-xl font-bold mb-4">Aksi Cepat</h2>
                <div class="space-y-2">
                    <a href="{{ route('settings.edit') }}" class="block px-4 py-3 rounded-xl bg-cyan-400/10 text-cyan-400 text-sm font-bold hover:bg-cyan-400 hover:text-slate-950 transition">⚙️ Edit Profil & Konten</a>
                    <a href="{{ route('admin.create', ['resource' => 'projects']) }}" class="block px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-sm font-bold hover:border-cyan-400 transition">+ Tambah Proyek Baru</a>
                    <a href="{{ route('messages.index') }}" class="block px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-sm font-bold hover:border-cyan-400 transition">✉️ Lihat Pesan Masuk</a>
                    <a href="{{ route('home') }}" target="_blank" class="block px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-sm font-bold hover:border-cyan-400 transition">🌐 Lihat Website ↗</a>
                </div>
            </div>

            <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800">
                <h2 class="text-lg font-bold mb-4">Pesan Terbaru</h2>
                <div class="space-y-3">
                    @forelse($recentMessages as $message)
                        <a href="{{ route('messages.show', $message) }}" class="block p-3 rounded-xl bg-slate-950 border border-slate-800 hover:border-cyan-400 transition">
                            <div class="flex justify-between gap-2">
                                <p class="font-bold text-sm truncate">{{ $message->name }}</p>
                                <span class="text-xs text-slate-500 shrink-0">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-500 truncate mt-1">{{ $message->subject ?: $message->message }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada pesan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio digital {{ $settings['full_name'] }} - {{ $settings['tagline'] }}">
    <title>{{ $settings['full_name'] }} — Portfolio</title>

    <script>
        // Terapkan tema sebelum halaman dirender agar tidak berkedip
        if (!localStorage.getItem('theme')) localStorage.setItem('theme', 'dark');
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <!-- Aset statis dengan nama tetap: tidak bergantung pada manifest Vite di server -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 overflow-x-hidden selection:bg-cyan-400 selection:text-slate-950">

@php
    $wa = preg_replace('/\D/', '', $settings['whatsapp'] ?? '');
    $avatar = ! empty($settings['avatar']) ? asset($settings['avatar']) : asset('images/dina.jpg');
    $hardSkills = $skills->where('category', 'Hard Skill');
    $softSkills = $skills->where('category', 'Soft Skill');
    $categories = $projects->pluck('category')->filter()->unique()->values();
@endphp

<!-- ================= NAVBAR ================= -->
<nav class="fixed top-0 left-0 w-full z-50 border-b border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/85 backdrop-blur-lg">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 py-3.5 flex justify-between items-center">
        <a href="#home" class="text-2xl sm:text-3xl font-extrabold tracking-tight text-cyan-600 dark:text-cyan-400">
            {{ $settings['nickname'] }}<span class="text-slate-900 dark:text-white">.</span>
        </a>

        <div class="hidden lg:flex items-center gap-6 text-sm font-medium">
            <a href="#home" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Beranda</a>
            <a href="#about" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Tentang</a>
            <a href="#skills" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Keahlian</a>
            <a href="#projects" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Proyek</a>
            <a href="#certificates" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Sertifikat</a>
            <a href="#experience" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Pengalaman</a>
            <a href="#blog" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Blog</a>
            <a href="#contact" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Kontak</a>
            <a href="#testimonials" class="nav-link hover:text-cyan-600 dark:hover:text-cyan-400 transition">Testimoni</a>
        </div>

        <div class="flex items-center gap-3">
            <button id="theme-toggle" type="button" aria-label="Ganti tema"
                class="w-10 h-10 rounded-xl border border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-slate-800 transition">
                <svg id="theme-sun" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="4"/><path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                </svg>
                <svg id="theme-moon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            <button id="menu-btn" type="button" aria-label="Buka menu" class="lg:hidden flex flex-col gap-1.5 p-2">
                <span class="w-6 h-0.5 bg-slate-800 dark:bg-white rounded"></span>
                <span class="w-6 h-0.5 bg-slate-800 dark:bg-white rounded"></span>
                <span class="w-6 h-0.5 bg-slate-800 dark:bg-white rounded"></span>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 px-5 py-4">
        <div class="grid grid-cols-2 gap-3 text-sm font-medium">
            <a href="#home" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Beranda</a>
            <a href="#about" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Tentang</a>
            <a href="#skills" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Keahlian</a>
            <a href="#projects" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Proyek</a>
            <a href="#certificates" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Sertifikat</a>
            <a href="#experience" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Pengalaman</a>
            <a href="#blog" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Blog</a>
            <a href="#contact" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Kontak</a>
            <a href="#testimonials" class="mobile-link py-2 hover:text-cyan-600 dark:hover:text-cyan-400">Testimoni</a>
        </div>
    </div>
</nav>

<!-- ================= BERANDA ================= -->
<section id="home" class="min-h-screen flex items-center pt-28 pb-16 px-5 sm:px-6 page-enter">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 lg:gap-20 items-center w-full">
        <div class="order-2 md:order-1 text-center md:text-left reveal">
            <p class="text-cyan-600 dark:text-cyan-400 text-sm sm:text-base font-bold uppercase tracking-[0.25em] mb-5">
                {{ $settings['hero_badge'] }}
            </p>

            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-[1.1] mb-5">
                Halo, Saya
                <span class="block text-cyan-600 dark:text-cyan-400 mt-1">{{ $settings['nickname'] }}</span>
            </h1>

            <h2 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-slate-700 dark:text-slate-300 mb-5">
                {{ $settings['tagline'] }}
            </h2>

            <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg leading-relaxed max-w-xl mx-auto md:mx-0 mb-6">
                {{ $settings['hero_description'] }}
            </p>

            <p class="text-sm text-slate-500 dark:text-slate-400 mb-8">
                {{ $settings['class'] }} &nbsp;•&nbsp; {{ $settings['competency'] }}
            </p>

            <div class="flex flex-wrap gap-3 justify-center md:justify-start mb-10">
                <a href="#projects" class="px-6 py-3.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold shadow-lg shadow-cyan-500/30 hover:-translate-y-1 transition">
                    Lihat Portfolio
                </a>
                <a href="/cv" target="_blank" class="px-6 py-3.5 rounded-xl border border-cyan-500 text-cyan-700 dark:text-cyan-400 hover:bg-cyan-500 hover:text-slate-950 font-bold hover:-translate-y-1 transition">
                    Lihat CV
                </a>
                <a href="#contact" class="px-6 py-3.5 rounded-xl border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 dark:hover:text-cyan-400 font-bold hover:-translate-y-1 transition">
                    Hubungi Saya
                </a>
            </div>

            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                @foreach($hardSkills->take(6) as $skill)
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-cyan-100 dark:bg-cyan-400/10 text-cyan-800 dark:text-cyan-300 border border-cyan-200 dark:border-cyan-400/20">
                        {{ $skill->name }}
                    </span>
                @endforeach
            </div>
        </div>

        <div class="order-1 md:order-2 flex justify-center reveal">
            <div class="relative">
                <div class="absolute inset-0 bg-cyan-400/30 blur-3xl rounded-full animate-pulse"></div>
                <img src="{{ $avatar }}" alt="Foto profil {{ $settings['full_name'] }}"
                    class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 object-cover rounded-full border-4 border-cyan-400 shadow-2xl">
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 px-5 py-2 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-lg text-sm font-bold whitespace-nowrap">
                    {{ $settings['full_name'] }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= TENTANG SAYA ================= -->
<section id="about" class="py-24 px-5 sm:px-6 bg-white dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-14">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Tentang Saya</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Kenalan Lebih Dekat</h2>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
            <h3 class="text-2xl sm:text-3xl font-bold leading-snug">
                {{ $settings['tagline'] }}
            </h3>

            <!-- Narasi utama. Seluruh identitas sudah disatuikan di sini agar tidak duplikat. -->
            <div class="text-slate-600 dark:text-slate-400 leading-relaxed text-lg">
                <p>{!! nl2br(e($settings['about_biodata'])) !!}</p>
            </div>

            <!-- Dua kotak tersisa ditempatkan di bawah narasi -->
            <div class="grid sm:grid-cols-2 gap-4 pt-2">
                @foreach([
                    ['🎓', 'Riwayat Pendidikan', $settings['education']],
                    ['🎯', 'Cita-cita / Tujuan Karir', $settings['career_goal']],
                ] as [$icon, $title, $body])
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 hover:border-cyan-400 transition">
                        <div class="text-2xl mb-3">{{ $icon }}</div>
                        <h4 class="font-bold mb-2">{{ $title }}</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed whitespace-pre-line">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ================= KEAHLIAN ================= -->
<section id="skills" class="py-24 px-5 sm:px-6">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-14">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Keahlian</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Hard Skill & Soft Skill</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">
                Kemampuan yang saya kuasai dan terus saya kembangkan lewat belajar mandiri, sekolah, serta proyek nyata.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            @foreach([
                ['Hard Skill', $hardSkills, 'bg-cyan-500', 'text-cyan-600 dark:text-cyan-400'],
                ['Soft Skill', $softSkills, 'bg-violet-500', 'text-violet-600 dark:text-violet-400'],
            ] as [$groupName, $groupSkills, $barColor, $labelColor])
                <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xl">
                    <h3 class="text-2xl font-bold mb-7 {{ $labelColor }}">{{ $groupName }}</h3>
                    <div class="space-y-5">
                        @forelse($groupSkills as $skill)
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-sm sm:text-base">
                                        {{ $skill->icon }} {{ $skill->name }}
                                    </span>
                                    <span class="text-sm font-bold {{ $labelColor }}">{{ $skill->percentage }}%</span>
                                </div>
                                <div class="h-2.5 w-full rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                                    <div class="h-full rounded-full {{ $barColor }} transition-all duration-1000"
                                        data-progress="{{ $skill->percentage }}" style="width: 0%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada data keahlian.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= PROYEK ================= -->
<section id="projects" class="py-24 px-5 sm:px-6 bg-slate-100/70 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-10">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Galeri Proyek</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Proyek Saya</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">
                Beberapa karya yang pernah saya buat, lengkap dengan proses, teknologi, dan feedback pengguna.
            </p>
        </div>

        <!-- Pencarian & Filter -->
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-8">
            <div class="relative w-full md:max-w-sm">
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="M20 20l-3.5-3.5"/>
                </svg>
                <input id="project-search" type="search" placeholder="Cari proyek atau teknologi..."
                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
            </div>
            <div id="project-filters" class="flex flex-wrap gap-2 justify-center">
                <button type="button" data-filter="all" class="filter-btn px-4 py-2 rounded-full text-sm font-semibold bg-cyan-500 text-slate-950">Semua</button>
                @foreach($categories as $category)
                    <button type="button" data-filter="{{ $category }}" class="filter-btn px-4 py-2 rounded-full text-sm font-semibold bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 hover:border-cyan-500 transition">{{ $category }}</button>
                @endforeach
            </div>
        </div>

        <div id="project-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @forelse($projects as $project)
                <article class="project-card group flex flex-col rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:-translate-y-2 hover:border-cyan-500 hover:shadow-2xl transition duration-300"
                    data-category="{{ $project->category }}" data-search="{{ strtolower($project->title . ' ' . $project->technologies . ' ' . $project->description) }}">
                    <div class="relative overflow-hidden h-52 shrink-0 bg-slate-200 dark:bg-slate-800">
                        <img src="{{ stored_image($project->image, $avatar) }}" alt="{{ $project->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold bg-cyan-500 text-slate-950">
                            {{ $project->category ?: 'Proyek' }}
                        </span>
                        @if($project->is_featured)
                            <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold bg-white/90 dark:bg-slate-950/80">⭐ Unggulan</span>
                        @endif
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-xl font-bold mb-2">{{ $project->title }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-4 flex-1">
                            {{ \Illuminate\Support\Str::limit($project->description, 110) }}
                        </p>

                        <div class="flex flex-wrap gap-1.5 mb-5">
                            @foreach(array_slice($project->technology_list, 0, 4) as $tech)
                                <span class="px-2 py-1 rounded-md text-[11px] font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">#{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="openProject({{ $project->id }})"
                                class="px-4 py-2.5 rounded-lg bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-sm font-bold transition">Preview & Detail</button>
                            @if($project->demo)
                                <a href="{{ $project->demo }}" target="_blank" rel="noopener"
                                    class="px-4 py-2.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-semibold hover:border-cyan-500 hover:text-cyan-600 dark:hover:text-cyan-400 transition">Demo</a>
                            @endif
                            @if($project->github)
                                <a href="{{ $project->github }}" target="_blank" rel="noopener"
                                    class="px-4 py-2.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-semibold hover:border-cyan-500 hover:text-cyan-600 dark:hover:text-cyan-400 transition">GitHub</a>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full text-center text-slate-500 py-10">Belum ada proyek yang ditampilkan.</p>
            @endforelse
        </div>

        <p id="project-empty" class="hidden text-center text-slate-500 py-10">Tidak ada proyek yang cocok dengan pencarian Anda.</p>
    </div>
</section>

<!-- Detail proyek (disimpan tersembunyi, dipindah ke modal oleh JS) -->
<div id="project-details" class="hidden">
    @foreach($projects as $project)
        <div id="project-detail-{{ $project->id }}">
            <img src="{{ stored_image($project->image, $avatar) }}" alt="{{ $project->title }}"
                class="w-full h-64 sm:h-80 object-cover rounded-2xl mb-6">

            <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-100 dark:bg-cyan-400/10 text-cyan-800 dark:text-cyan-300">{{ $project->category ?: 'Proyek' }}</span>
                @if($project->is_featured)
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-400/10 text-amber-800 dark:text-amber-300">⭐ Proyek Unggulan</span>
                @endif
            </div>

            <h3 class="text-2xl sm:text-3xl font-extrabold mb-3">{{ $project->title }}</h3>
            <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-6">{{ $project->description }}</p>

            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                @foreach([
                    ['❓', 'Permasalahan', $project->problem],
                    ['🎯', 'Tujuan', $project->goal],
                    ['👤', 'Peran Saya', $project->role],
                    ['🛠️', 'Teknologi', implode(', ', $project->technology_list)],
                ] as [$icon, $label, $value])
                    @if($value)
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800">
                            <p class="font-bold text-sm mb-1">{{ $icon }} {{ $label }}</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed whitespace-pre-line">{{ $value }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            @if(count($project->feature_list))
                <div class="mb-6">
                    <h4 class="font-bold mb-2">✨ Fitur Proyek</h4>
                    <ul class="grid sm:grid-cols-2 gap-2">
                        @foreach($project->feature_list as $feature)
                            <li class="flex gap-2 text-sm text-slate-600 dark:text-slate-300">
                                <span class="text-cyan-500">✓</span><span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($project->story)
                <div class="mb-6">
                    <h4 class="font-bold mb-2">📖 Cerita Proses Pembuatan</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">{{ $project->story }}</p>
                </div>
            @endif

            @if($project->detail)
                <div class="mb-6">
                    <h4 class="font-bold mb-2">📝 Detail Proyek</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">{{ $project->detail }}</p>
                </div>
            @endif

            @if($project->feedback)
                <blockquote class="mb-6 p-4 rounded-xl border-l-4 border-cyan-500 bg-cyan-50 dark:bg-cyan-400/5 text-sm italic text-slate-600 dark:text-slate-300">
                    💬 {{ $project->feedback }}
                </blockquote>
            @endif

            <div class="flex flex-wrap gap-3 pt-2">
                @if($project->demo)
                    <a href="{{ $project->demo }}" target="_blank" rel="noopener" class="px-5 py-3 rounded-xl bg-cyan-500 text-slate-950 text-sm font-bold">Lihat Demo</a>
                @endif
                @if($project->github)
                    <a href="{{ $project->github }}" target="_blank" rel="noopener" class="px-5 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-sm font-bold hover:border-cyan-500">Source Code GitHub</a>
                @endif
                @if($project->documentation)
                    <a href="{{ $project->documentation }}" target="_blank" rel="noopener" class="px-5 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-sm font-bold hover:border-cyan-500">Dokumentasi Proses</a>
                @endif
            </div>
        </div>
    @endforeach
</div>

<!-- ================= SERTIFIKAT & PRESTASI ================= -->
<section id="certificates" class="py-24 px-5 sm:px-6">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-14">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Sertifikat & Prestasi</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Pencapaian Saya</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($certificates as $certificate)
                <div class="group rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:-translate-y-2 hover:border-cyan-500 transition">
                    @if($certificate->image)
                        <button type="button" onclick="openLightbox('{{ stored_image($certificate->image) }}')" class="w-full h-44 overflow-hidden bg-slate-100 dark:bg-slate-800 block">
                            <img src="{{ stored_image($certificate->image) }}" alt="{{ $certificate->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                        </button>
                    @else
                        <div class="w-full h-44 flex items-center justify-center bg-cyan-50 dark:bg-cyan-400/5 text-5xl">🏆</div>
                    @endif
                    <div class="p-5">
                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold mb-3 {{ $certificate->category === 'Prestasi' ? 'bg-amber-100 dark:bg-amber-400/10 text-amber-800 dark:text-amber-300' : 'bg-cyan-100 dark:bg-cyan-400/10 text-cyan-800 dark:text-cyan-300' }}">
                            {{ $certificate->category }}
                        </span>
                        <h3 class="font-bold leading-snug mb-2">{{ $certificate->title }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">{{ $certificate->issuer }}</p>
                        <p class="text-xs font-semibold text-cyan-600 dark:text-cyan-400">{{ $certificate->year }}</p>
                        @if($certificate->description)
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">{{ $certificate->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-slate-500">Belum ada sertifikat atau prestasi.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= PENGALAMAN ================= -->
<section id="experience" class="py-24 px-5 sm:px-6 bg-slate-100/70 dark:bg-slate-900/50">
    <div class="max-w-5xl mx-auto reveal">
        <div class="text-center mb-12">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Pengalaman</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Perjalanan Saya</h2>
        </div>

        <div id="experience-tabs" class="flex flex-wrap justify-center gap-2 mb-10">
            @foreach(['Semua', 'PLK', 'Organisasi', 'Lomba'] as $type)
                <button type="button" data-type="{{ $type }}" class="experience-tab px-5 py-2.5 rounded-full text-sm font-bold border border-slate-300 dark:border-slate-700 {{ $loop->first ? 'bg-cyan-500 text-slate-950 border-cyan-500' : 'hover:border-cyan-500' }}">{{ $type }}</button>
            @endforeach
        </div>

        <div class="relative border-l-2 border-cyan-500/40 pl-6 sm:pl-10 space-y-8">
            @forelse($experiences as $experience)
                <div class="experience-item relative" data-type="{{ $experience->type }}">
                    <span class="absolute -left-[33px] sm:-left-[49px] top-1 w-5 h-5 rounded-full bg-cyan-500 border-4 border-slate-100 dark:border-slate-900"></span>
                    <div class="p-5 sm:p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-100 dark:bg-cyan-400/10 text-cyan-800 dark:text-cyan-300">{{ $experience->type }}</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">{{ $experience->period }}</span>
                        </div>
                        <h3 class="text-lg font-bold mb-1">{{ $experience->title }}</h3>
                        <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400 mb-2">{{ $experience->organization }}</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $experience->description }}</p>
                    </div>
                </div>
            @empty
                <p class="text-slate-500">Belum ada pengalaman yang ditambahkan.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= BLOG ================= -->
<section id="blog" class="py-24 px-5 sm:px-6">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-12">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Blog Pengembang</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Catatan Ngoding</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">
                Tutorial singkat, cerita proses, dan dokumentasi solusi masalah yang saya temui saat belajar dan berkarya.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @forelse($blogPosts as $post)
                <a href="{{ route('blog.show', $post) }}" class="group rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:-translate-y-2 hover:border-cyan-500 transition">
                    <div class="h-44 overflow-hidden bg-slate-200 dark:bg-slate-800">
                        @if($post->image)
                            <img src="{{ stored_image($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-5xl bg-cyan-50 dark:bg-cyan-400/5">📝</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400 mb-3">
                            <span class="px-3 py-1 rounded-full bg-cyan-100 dark:bg-cyan-400/10 text-cyan-800 dark:text-cyan-300 font-bold">{{ $post->category }}</span>
                            <span>{{ optional($post->published_at)->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-lg font-bold mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition">{{ $post->title }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-4">{{ $post->excerpt }}</p>
                        <span class="text-sm font-bold text-cyan-600 dark:text-cyan-400">Baca artikel →</span>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-slate-500">Belum ada artikel yang diterbitkan.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= KONTAK & KESAN PESAN ================= -->
<section id="contact" class="py-24 px-5 sm:px-6 bg-slate-100/70 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-12">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Kontak</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Mari Terhubung</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4">Saya terbuka untuk diskusi, kolaborasi, atau sekadar berkenalan.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Kartu kontak -->
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach([
                    ['✉️', 'Email', $settings['email'], 'mailto:'.$settings['email']],
                    ['📱', 'WhatsApp', $settings['phone'], 'https://wa.me/'.$wa],
                    ['🐙', 'GitHub', 'Lihat repository', $settings['github']],
                    ['📸', 'Instagram', $settings['instagram'] ?: '-', $settings['instagram']],
                    ['💼', 'LinkedIn', 'Profil LinkedIn', $settings['linkedin']],
                    ['📍', 'Lokasi', $settings['location'], '#home'],
                ] as [$icon, $label, $value, $link])
                    <a href="{{ $link ?: '#' }}" target="_blank" rel="noopener"
                        class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:-translate-y-1 hover:border-cyan-500 transition">
                        <div class="text-2xl mb-3">{{ $icon }}</div>
                        <p class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">{{ $label }}</p>
                        <p class="font-semibold text-sm break-all">{{ $value ?: '-' }}</p>
                    </a>
                @endforeach
            </div>

            <!-- Form kesan & pesan -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xl">
                <h3 class="text-2xl font-bold mb-2">Kesan & Pesan</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Tinggalkan pesan untuk saya — semua pesan masuk ke dashboard admin.</p>

                @if(session('success'))
                    <div class="mb-5 p-4 rounded-xl bg-emerald-100 dark:bg-emerald-400/10 border border-emerald-300 dark:border-emerald-400/30 text-emerald-800 dark:text-emerald-300 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 p-4 rounded-xl bg-red-100 dark:bg-red-400/10 border border-red-300 dark:border-red-400/30 text-red-800 dark:text-red-300 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nama Anda"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-semibold mb-2">Subjek (opsional)</label>
                        <input id="subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="Topik pesan"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-semibold mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tulis kesan dan pesan Anda..."
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ================= TESTIMONI (SECTION PALING AKHIR) ================= -->
<section id="testimonials" class="py-24 px-5 sm:px-6 bg-slate-100/70 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto reveal">
        <div class="text-center mb-12">
            <p class="text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-[0.2em] text-sm mb-3">Testimoni</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold">Kata Mereka Tentang Saya</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">
                Cerita singkat dari guru, teman, pengguna, dan rekan PLK. Mau ikut berbagi? Isi form di bawah —
                testimoni kamu akan tampil setelah disetujui admin.
            </p>
        </div>

        <div id="testimonial-tabs" class="flex flex-wrap justify-center gap-2 mb-10">
            @foreach(['Semua', 'Guru Pembimbing', 'Teman', 'Pengguna', 'Tempat PLK', 'Lainnya'] as $category)
                <button type="button" data-category="{{ $category }}" class="testimonial-tab px-4 py-2 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 {{ $loop->first ? 'bg-cyan-500 text-slate-950 border-cyan-500' : 'hover:border-cyan-500' }}">{{ $category }}</button>
            @endforeach
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($testimonials as $testimonial)
                <div class="testimonial-item p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800" data-category="{{ $testimonial->category }}">
                    <div class="text-3xl text-cyan-500 mb-3">“</div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">{{ $testimonial->message }}</p>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-cyan-100 dark:bg-cyan-400/10 flex items-center justify-center font-bold text-cyan-700 dark:text-cyan-300">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm">{{ $testimonial->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $testimonial->role }} • {{ $testimonial->category }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-slate-500">Belum ada testimoni yang ditampilkan.</p>
            @endforelse
        </div>

        <!-- Form kirim testimoni -->
        <div class="mt-14 max-w-3xl mx-auto p-6 sm:p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xl">
            <h3 class="text-2xl font-bold mb-2">Tinggalkan Testimoni</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Tulis kesan kamu tentang saya atau portofolio ini. Testimoni baru tampil setelah admin menyetujuinya.</p>

            @if(session('testimonial_success'))
                <div class="mb-5 p-4 rounded-xl bg-emerald-100 dark:bg-emerald-400/10 border border-emerald-300 dark:border-emerald-400/30 text-emerald-800 dark:text-emerald-300 text-sm">
                    {{ session('testimonial_success') }}
                </div>
            @endif

            @if($errors->testimonial->any())
                <div class="mb-5 p-4 rounded-xl bg-red-100 dark:bg-red-400/10 border border-red-300 dark:border-red-400/30 text-red-800 dark:text-red-300 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->testimonial->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('testimonials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="testimonial_name" class="block text-sm font-semibold mb-2">Nama</label>
                        <input id="testimonial_name" name="testimonial_name" type="text" value="{{ old('testimonial_name') }}" placeholder="Nama Anda"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
                    </div>
                    <div>
                        <label for="testimonial_role" class="block text-sm font-semibold mb-2">Peran / Jabatan (opsional)</label>
                        <input id="testimonial_role" name="testimonial_role" type="text" value="{{ old('testimonial_role') }}" placeholder="Contoh: Guru BK"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
                    </div>
                </div>
                <div>
                    <label for="testimonial_category" class="block text-sm font-semibold mb-2">Kategori</label>
                    <select id="testimonial_category" name="testimonial_category"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">
                        <option value="">Pilih kategori</option>
                        @foreach(['Guru Pembimbing', 'Teman', 'Pengguna', 'Tempat PLK', 'Lainnya'] as $category)
                            <option value="{{ $category }}" {{ old('testimonial_category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="testimonial_message" class="block text-sm font-semibold mb-2">Isi Testimoni</label>
                    <textarea id="testimonial_message" name="testimonial_message" rows="5" placeholder="Ceritakan kesan kamu..."
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 focus:border-cyan-500 outline-none text-sm">{{ old('testimonial_message') }}</textarea>
                </div>
                <button type="submit" class="w-full py-3.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold transition">
                    Kirim Testimoni
                </button>
            </form>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="py-10 px-5 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 text-center">
    <p class="font-bold text-lg text-cyan-600 dark:text-cyan-400">{{ $settings['nickname'] }}.</p>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">© {{ date('Y') }} {{ $settings['full_name'] }}. Dibangun dengan Laravel & Tailwind CSS.</p>
    <a href="/login" class="inline-block mt-4 text-xs text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition">Admin</a>
</footer>

<!-- ================= TOMBOL KEMBALI KE ATAS ================= -->
<button id="back-to-top" type="button" aria-label="Kembali ke atas"
    class="fixed bottom-6 right-6 z-40 w-12 h-12 rounded-full bg-cyan-500 text-slate-950 font-bold text-xl shadow-xl hidden hover:scale-110 transition">↑</button>

<!-- ================= MODAL PROYEK ================= -->
<div id="project-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 modal-backdrop">
    <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-2xl">
        <button type="button" onclick="closeProjectModal()" aria-label="Tutup"
            class="sticky float-right top-0 w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center text-xl font-bold z-10">×</button>
        <div id="project-modal-body"></div>
    </div>
</div>

<!-- ================= LIGHTBOX GAMBAR ================= -->
<div id="lightbox" class="fixed inset-0 z-[110] hidden items-center justify-center p-6 modal-backdrop" onclick="closeLightbox()">
    <button type="button" class="absolute top-6 right-6 text-white text-4xl leading-none">×</button>
    <img id="lightbox-image" src="" alt="Dokumentasi" class="max-w-full max-h-[85vh] rounded-xl shadow-2xl">
</div>

<script>
    /* ---------- Tema dark / light ---------- */
    const themeToggle = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('theme-sun');
    const moonIcon = document.getElementById('theme-moon');

    function syncThemeIcons() {
        const isDark = document.documentElement.classList.contains('dark');
        sunIcon.classList.toggle('hidden', isDark);
        moonIcon.classList.toggle('hidden', !isDark);
    }
    syncThemeIcons();

    themeToggle.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        syncThemeIcons();
    });

    /* ---------- Menu mobile ---------- */
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    document.querySelectorAll('.mobile-link').forEach(link => {
        link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
    });

    /* ---------- Animasi muncul ---------- */
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    /* ---------- Progress bar skill ---------- */
    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.width = entry.target.dataset.progress + '%';
                progressObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('[data-progress]').forEach(el => progressObserver.observe(el));

    /* ---------- Back to top ---------- */
    const backToTop = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        backToTop.classList.toggle('hidden', window.scrollY < 400);
    });
    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    /* ---------- Nav aktif ---------- */
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = [...document.querySelectorAll('section[id]')];
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            if (window.scrollY >= section.offsetTop - 150) current = section.id;
        });
        navLinks.forEach(link => {
            link.classList.toggle('text-cyan-600', link.getAttribute('href') === '#' + current);
            link.classList.toggle('dark:text-cyan-400', link.getAttribute('href') === '#' + current);
        });
    });

    /* ---------- Pencarian & filter proyek ---------- */
    const searchInput = document.getElementById('project-search');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const cards = [...document.querySelectorAll('.project-card')];
    const emptyState = document.getElementById('project-empty');
    let activeCategory = 'all';

    function filterProjects() {
        const query = searchInput.value.trim().toLowerCase();
        let visible = 0;
        cards.forEach(card => {
            const matchCategory = activeCategory === 'all' || card.dataset.category === activeCategory;
            const matchQuery = card.dataset.search.includes(query);
            const show = matchCategory && matchQuery;
            card.classList.toggle('hidden', !show);
            if (show) visible++;
        });
        emptyState.classList.toggle('hidden', visible !== 0);
    }
    searchInput.addEventListener('input', filterProjects);
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            activeCategory = button.dataset.filter;
            filterButtons.forEach(btn => {
                const active = btn === button;
                btn.classList.toggle('bg-cyan-500', active);
                btn.classList.toggle('text-slate-950', active);
                btn.classList.toggle('bg-white', !active);
                btn.classList.toggle('dark:bg-slate-900', !active);
                btn.classList.toggle('border', !active);
            });
            filterProjects();
        });
    });

    /* ---------- Modal detail proyek ---------- */
    const projectModal = document.getElementById('project-modal');
    function openProject(id) {
        const source = document.getElementById('project-detail-' + id);
        if (!source) return;
        document.getElementById('project-modal-body').innerHTML = source.innerHTML;
        projectModal.classList.remove('hidden');
        projectModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeProjectModal() {
        projectModal.classList.add('hidden');
        projectModal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    projectModal.addEventListener('click', (event) => {
        if (event.target === projectModal) closeProjectModal();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeProjectModal();
            closeLightbox();
        }
    });

    /* ---------- Lightbox ---------- */
    const lightbox = document.getElementById('lightbox');
    function openLightbox(src) {
        document.getElementById('lightbox-image').src = src;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
    }
    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
    }

    /* ---------- Tab pengalaman ---------- */
    document.querySelectorAll('.experience-tab').forEach(button => {
        button.addEventListener('click', () => {
            const type = button.dataset.type;
            document.querySelectorAll('.experience-tab').forEach(btn => {
                const active = btn === button;
                btn.classList.toggle('bg-cyan-500', active);
                btn.classList.toggle('text-slate-950', active);
                btn.classList.toggle('border-cyan-500', active);
            });
            document.querySelectorAll('.experience-item').forEach(item => {
                item.classList.toggle('hidden', type !== 'Semua' && item.dataset.type !== type);
            });
        });
    });

    /* ---------- Tab testimoni ---------- */
    document.querySelectorAll('.testimonial-tab').forEach(button => {
        button.addEventListener('click', () => {
            const category = button.dataset.category;
            document.querySelectorAll('.testimonial-tab').forEach(btn => {
                const active = btn === button;
                btn.classList.toggle('bg-cyan-500', active);
                btn.classList.toggle('text-slate-950', active);
                btn.classList.toggle('border-cyan-500', active);
            });
            document.querySelectorAll('.testimonial-item').forEach(item => {
                item.classList.toggle('hidden', category !== 'Semua' && item.dataset.category !== category);
            });
        });
    });
</script>

</body>
</html>

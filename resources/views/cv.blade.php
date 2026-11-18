<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Digital — {{ $settings['full_name'] }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: #0f172a !important; }
            .print-card { box-shadow: none !important; border: none !important; }
            @page { margin: 14mm; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 py-10 px-4">

<div class="no-print max-w-4xl mx-auto mb-5 flex flex-wrap gap-3 items-center justify-between">
    <a href="/" class="text-sm font-semibold text-cyan-700 hover:underline">← Kembali ke Portfolio</a>
    <div class="flex gap-3">
        <a href="/" class="px-4 py-2 rounded-lg border border-slate-300 bg-white text-sm font-bold hover:border-cyan-500">Beranda</a>
        <button onclick="window.print()" class="px-4 py-2 rounded-lg bg-cyan-600 text-white text-sm font-bold hover:bg-cyan-500">Cetak / Simpan PDF</button>
    </div>
</div>

<div class="print-card max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl p-8 sm:p-12">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start border-b-2 border-cyan-500 pb-7 mb-8">
        <img src="{{ !empty($settings['avatar']) ? asset($settings['avatar']) : asset('images/dina.jpg') }}"
            alt="Foto {{ $settings['full_name'] }}" class="w-28 h-28 rounded-full object-cover border-4 border-cyan-500 shrink-0">
        <div class="text-center sm:text-left">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">{{ $settings['full_name'] }}</h1>
            <p class="text-lg font-semibold text-cyan-700 mt-1">{{ $settings['tagline'] }}</p>
            <div class="flex flex-wrap gap-x-4 gap-y-1 justify-center sm:justify-start mt-3 text-sm text-slate-600">
                <span>✉ {{ $settings['email'] }}</span>
                <span>☎ {{ $settings['phone'] }}</span>
                <span>📍 {{ $settings['location'] }}</span>
                <span>🐙 {{ $settings['github'] }}</span>
                @if($settings['linkedin'])<span>💼 {{ $settings['linkedin'] }}</span>@endif
            </div>
        </div>
    </div>

    <!-- Profil -->
    <section class="mb-7">
        <h2 class="text-lg font-extrabold text-cyan-700 uppercase tracking-wider border-b border-slate-200 pb-2 mb-3">Profil Singkat</h2>
        <p class="text-sm leading-relaxed whitespace-pre-line">{{ $settings['about_biodata'] }}</p>
    </section>

    <div class="grid md:grid-cols-2 gap-8">
        <div>
            <!-- Pendidikan -->
            <section class="mb-7">
                <h2 class="text-lg font-extrabold text-cyan-700 uppercase tracking-wider border-b border-slate-200 pb-2 mb-3">Riwayat Pendidikan</h2>
                <p class="text-sm leading-relaxed whitespace-pre-line">{{ $settings['education'] }}</p>
                <p class="text-sm mt-2"><strong>Kelas:</strong> {{ $settings['class'] }}</p>
                <p class="text-sm"><strong>Kompetensi:</strong> {{ $settings['competency'] }}</p>
            </section>

            <!-- Keahlian -->
            <section class="mb-7">
                <h2 class="text-lg font-extrabold text-cyan-700 uppercase tracking-wider border-b border-slate-200 pb-2 mb-3">Keahlian</h2>
                @foreach($skills->groupBy('category') as $category => $group)
                    <h3 class="font-bold text-sm mt-3 mb-1">{{ $category }}</h3>
                    <ul class="flex flex-wrap gap-2">
                        @foreach($group as $skill)
                            <li class="px-2.5 py-1 rounded-md bg-slate-100 text-xs font-semibold">{{ $skill->name }} ({{ $skill->percentage }}%)</li>
                        @endforeach
                    </ul>
                @endforeach
            </section>
        </div>

        <div>
            <!-- Pengalaman -->
            <section class="mb-7">
                <h2 class="text-lg font-extrabold text-cyan-700 uppercase tracking-wider border-b border-slate-200 pb-2 mb-3">Pengalaman</h2>
                @forelse($experiences as $experience)
                    <div class="mb-4">
                        <p class="font-bold text-sm">{{ $experience->title }}</p>
                        <p class="text-xs text-cyan-700">{{ $experience->organization }} • {{ $experience->period }} • {{ $experience->type }}</p>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $experience->description }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada pengalaman.</p>
                @endforelse
            </section>

            <!-- Sertifikat -->
            <section class="mb-7">
                <h2 class="text-lg font-extrabold text-cyan-700 uppercase tracking-wider border-b border-slate-200 pb-2 mb-3">Sertifikat & Prestasi</h2>
                @forelse($certificates as $certificate)
                    <p class="text-sm mb-1"><strong>{{ $certificate->title }}</strong> — {{ $certificate->issuer }} ({{ $certificate->year }})</p>
                @empty
                    <p class="text-sm text-slate-500">Belum ada sertifikat.</p>
                @endforelse
            </section>
        </div>
    </div>

    <!-- Proyek -->
    <section>
        <h2 class="text-lg font-extrabold text-cyan-700 uppercase tracking-wider border-b border-slate-200 pb-2 mb-3">Proyek Pilihan</h2>
        <div class="grid sm:grid-cols-2 gap-4">
            @forelse($projects as $project)
                <div class="p-4 rounded-xl border border-slate-200">
                    <p class="font-bold text-sm">{{ $project->title }}</p>
                    <p class="text-xs text-cyan-700 mt-0.5">{{ $project->technologies }}</p>
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">{{ \Illuminate\Support\Str::limit($project->description, 150) }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-500">Belum ada proyek.</p>
            @endforelse
        </div>
    </section>
</div>

</body>
</html>

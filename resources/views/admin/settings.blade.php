@extends('admin.layout')

@section('title', 'Profil & Konten')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <p class="text-cyan-400 text-sm font-bold uppercase tracking-widest mb-2">Pengaturan Website</p>
        <h1 class="text-3xl font-extrabold">Kelola Informasi Profil & Konten</h1>
        <p class="text-slate-400 text-sm mt-2">
            Ubah teks di bawah ini tanpa menyentuh kode. Perubahan langsung tampil di halaman portfolio dan CV digital.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/40 text-red-300 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" class="space-y-8">
        @csrf
        @method('PUT')

        @foreach($groups as $groupName => $fields)
            <div class="p-6 sm:p-8 rounded-2xl bg-slate-900 border border-slate-800">
                <h2 class="text-xl font-bold text-cyan-400 mb-6">{{ $groupName }}</h2>
                <div class="grid sm:grid-cols-2 gap-5">
                    @foreach($fields as $key => $definition)
                        @php($type = $definition['type'] ?? 'text')
                        <div class="{{ $type === 'textarea' ? 'sm:col-span-2' : '' }}">
                            <label for="setting-{{ $key }}" class="block text-sm font-semibold mb-2 text-slate-300">
                                {{ $definition['label'] }}
                            </label>
                            @if($type === 'textarea')
                                <textarea id="setting-{{ $key }}" name="{{ $key }}" rows="4"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 focus:border-cyan-400 outline-none text-sm">{{ old($key, $settings[$key] ?? '') }}</textarea>
                            @else
                                <input id="setting-{{ $key }}" type="{{ $type }}" name="{{ $key }}"
                                    value="{{ old($key, $settings[$key] ?? '') }}"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-700 focus:border-cyan-400 outline-none text-sm">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('dashboard') }}" class="flex-1 text-center px-5 py-3.5 rounded-xl border border-slate-700 font-bold hover:bg-slate-800 transition">Batal</a>
            <button type="submit" class="flex-1 px-5 py-3.5 rounded-xl bg-cyan-400 text-slate-950 font-bold hover:bg-cyan-300 transition">
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

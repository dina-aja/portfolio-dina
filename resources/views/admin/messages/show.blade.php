@extends('admin.layout')

@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('messages.index') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-cyan-600 dark:text-cyan-400">← Kembali ke Pesan Masuk</a>

    <div class="mt-6 p-6 sm:p-8 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
        <h1 class="text-2xl font-extrabold mb-6">{{ $message->subject ?: '(Tanpa Subjek)' }}</h1>

        <dl class="grid sm:grid-cols-2 gap-4 mb-8">
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
                <dt class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">Nama</dt>
                <dd class="font-semibold">{{ $message->name }}</dd>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
                <dt class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">Email</dt>
                <dd class="font-semibold break-all">{{ $message->email }}</dd>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 sm:col-span-2">
                <dt class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1">Dikirim</dt>
                <dd class="font-semibold">{{ $message->created_at->format('d M Y, H:i') }}</dd>
            </div>
        </dl>

        <div class="p-5 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
            <p class="text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Isi Pesan</p>
            <p class="whitespace-pre-line leading-relaxed">{{ $message->message }}</p>
        </div>

        <div class="flex flex-wrap gap-3 mt-8">
            <a href="mailto:{{ $message->email }}" class="px-5 py-3 rounded-xl bg-cyan-500 text-slate-950 font-bold hover:bg-cyan-400">Balas via Email</a>
            <form method="POST" action="{{ route('messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-3 rounded-xl border border-red-300 dark:border-red-500/40 text-red-600 dark:text-red-400 font-bold hover:bg-red-500 hover:text-slate-900 dark:hover:text-white">Hapus Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection

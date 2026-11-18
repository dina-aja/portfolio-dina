@extends('admin.layout')

@section('title', 'Pesan Masuk')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <p class="text-cyan-400 text-sm font-bold uppercase tracking-widest mb-2">Kotak Masuk</p>
        <h1 class="text-3xl font-extrabold">Kesan & Pesan Pengunjung</h1>
        <p class="text-slate-400 text-sm mt-2">Kelola semua pesan yang dikirim dari formulir kontak website.</p>
    </div>

    <div class="rounded-2xl border border-slate-800 bg-slate-900 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-800/70 text-slate-400 text-left">
                    <tr>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Nama</th>
                        <th class="px-5 py-4">Email</th>
                        <th class="px-5 py-4">Subjek</th>
                        <th class="px-5 py-4">Waktu</th>
                        <th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($messages as $message)
                        <tr class="hover:bg-slate-800/40 {{ $message->is_read ? '' : 'bg-cyan-400/5' }}">
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $message->is_read ? 'bg-slate-800 text-slate-500' : 'bg-cyan-400/10 text-cyan-400' }}">
                                    {{ $message->is_read ? 'Dibaca' : 'Baru' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 font-semibold">{{ $message->name }}</td>
                            <td class="px-5 py-4 text-slate-400">{{ $message->email }}</td>
                            <td class="px-5 py-4 text-slate-400">{{ $message->subject ?: '-' }}</td>
                            <td class="px-5 py-4 text-slate-500 text-xs">{{ $message->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('messages.show', $message) }}" class="px-3 py-2 rounded-lg bg-cyan-400/10 border border-cyan-400/30 text-cyan-400 text-xs font-bold hover:bg-cyan-400 hover:text-slate-950 transition">Baca</a>
                                    <form method="POST" action="{{ route('messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold hover:bg-red-500 hover:text-white transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-slate-500">Belum ada pesan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

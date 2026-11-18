@extends('admin.layout')

@section('title', $config['title'])

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <p class="text-cyan-400 text-sm font-bold uppercase tracking-widest mb-2">Kelola Konten</p>
            <h1 class="text-3xl font-extrabold">{{ $config['title'] }}</h1>
            <p class="text-slate-400 text-sm mt-2">{{ $config['description'] }}</p>
        </div>
        <a href="{{ route('admin.create', ['resource' => $resource]) }}"
            class="px-5 py-3 rounded-xl bg-cyan-400 text-slate-950 font-bold hover:bg-cyan-300 transition">
            + Tambah {{ $config['singular'] }}
        </a>
    </div>

    <div class="rounded-2xl border border-slate-800 bg-slate-900 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-800/70 text-slate-400 text-left">
                    <tr>
                        <th class="px-5 py-4 font-semibold">#</th>
                        @foreach($config['columns'] as $column)
                            <th class="px-5 py-4 font-semibold">{{ str_replace('_', ' ', ucfirst($column)) }}</th>
                        @endforeach
                        <th class="px-5 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($items as $item)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-5 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            @foreach($config['columns'] as $column)
                                <td class="px-5 py-4">
                                    @if($column === 'is_featured')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $item->{$column} ? 'bg-cyan-400/10 text-cyan-400' : 'bg-slate-800 text-slate-500' }}">
                                            {{ $item->{$column} ? 'Ya' : 'Tidak' }}
                                        </span>
                                    @elseif($column === 'image')
                                        @if($item->{$column})
                                            <img src="{{ stored_image($item->{$column}) }}" class="w-14 h-12 object-cover rounded-lg" alt="">
                                        @else
                                            <span class="text-slate-600">-</span>
                                        @endif
                                    @else
                                        <span class="block max-w-xs truncate">{{ $item->{$column} ?: '-' }}</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.edit', ['resource' => $resource, 'item' => $item->id]) }}"
                                        class="px-3 py-2 rounded-lg bg-amber-400/10 border border-amber-400/30 text-amber-400 text-xs font-bold hover:bg-amber-400 hover:text-slate-950 transition">Edit</a>
                                    <form method="POST" action="{{ route('admin.destroy', ['resource' => $resource, 'item' => $item->id]) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold hover:bg-red-500 hover:text-white transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($config['columns']) + 2 }}" class="px-5 py-12 text-center text-slate-500">
                                Belum ada data. Klik tombol <strong>+ Tambah {{ $config['singular'] }}</strong> untuk membuat satu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

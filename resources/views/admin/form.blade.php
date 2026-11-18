@extends('admin.layout')

@section('title', ($item ? 'Edit ' : 'Tambah ') . $config['singular'])

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.index', ['resource' => $resource]) }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-cyan-600 dark:text-cyan-400 transition">← Kembali ke {{ $config['title'] }}</a>
        <h1 class="text-3xl font-extrabold mt-3">{{ $item ? 'Edit' : 'Tambah' }} {{ $config['singular'] }}</h1>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-300 dark:border-red-500/40 text-red-600 dark:text-red-400">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
        action="{{ $item ? route('admin.update', ['resource' => $resource, 'item' => $item->id]) : route('admin.store', ['resource' => $resource]) }}"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf
        @if($item)
            @method('PUT')
        @endif

        <div class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 grid sm:grid-cols-2 gap-6">
            @foreach($config['fields'] as $name => $field)
                @php
                    $type = $field['type'] ?? 'text';
                    $value = old($name, $item ? $item->{$name} : '');
                @endphp

                <div class="{{ in_array($type, ['textarea']) ? 'sm:col-span-2' : '' }}">
                    @if($type === 'checkbox')
                        <label class="flex items-center gap-3 cursor-pointer pt-6">
                            <input type="checkbox" name="{{ $name }}" value="1" {{ $item && $item->{$name} ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-950 text-cyan-600 dark:text-cyan-400 focus:ring-cyan-500">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $field['label'] }}</span>
                        </label>
                        @continue
                    @endif

                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">{{ $field['label'] }}</label>

                    @if($type === 'textarea')
                        <textarea name="{{ $name }}" rows="4" placeholder="{{ $field['label'] }}"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm">{{ $value }}</textarea>
                    @elseif($type === 'select')
                        <select name="{{ $name }}"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm">
                            @foreach($field['options'] as $optionValue => $optionLabel)
                                <option value="{{ $optionValue }}" {{ $value === $optionValue ? 'selected' : '' }}>{{ $optionLabel }}</option>
                            @endforeach
                        </select>
                    @elseif($type === 'image')
                        @if($item && $item->{$name})
                            <img src="{{ stored_image($item->{$name}) }}" alt="Preview" class="w-full h-40 object-cover rounded-xl mb-3 border border-slate-300 dark:border-slate-700">
                        @endif
                        <input type="file" name="{{ $name }}" accept="image/*"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 text-sm file:mr-4 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-cyan-500 file:text-slate-950 file:font-bold">
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Format: jpg, jpeg, png, webp. Maksimal 4 MB.</p>
                    @elseif($type === 'datetime-local')
                        <input type="datetime-local" name="{{ $name }}"
                            value="{{ old($name, $item && $item->{$name} ? $item->{$name}->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm">
                    @else
                        <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $field['label'] }}"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm">
                    @endif
                </div>
            @endforeach
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.index', ['resource' => $resource]) }}"
                class="flex-1 text-center px-5 py-3.5 rounded-xl border border-slate-300 dark:border-slate-700 font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition">Batal</a>
            <button type="submit" class="flex-1 px-5 py-3.5 rounded-xl bg-cyan-500 text-slate-950 font-bold hover:bg-cyan-400 transition">
                {{ $item ? 'Simpan Perubahan' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection

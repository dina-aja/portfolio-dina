<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} — {{ $settings['nickname'] }} Blog</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100">

<nav class="sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/85 backdrop-blur-lg">
    <div class="max-w-4xl mx-auto px-5 py-4 flex items-center justify-between">
        <a href="/" class="text-xl font-extrabold text-cyan-600 dark:text-cyan-400">{{ $settings['nickname'] }}.</a>
        <a href="/#blog" class="text-sm font-semibold hover:text-cyan-600 dark:hover:text-cyan-400">← Kembali ke Blog</a>
    </div>
</nav>

<article class="max-w-4xl mx-auto px-5 py-14">
    <div class="flex flex-wrap items-center gap-3 text-sm mb-5">
        <span class="px-3 py-1 rounded-full bg-cyan-100 dark:bg-cyan-400/10 text-cyan-800 dark:text-cyan-300 font-bold text-xs">{{ $post->category }}</span>
        <span class="text-slate-500 dark:text-slate-400">{{ optional($post->published_at)->format('d F Y') }}</span>
    </div>

    <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight mb-6">{{ $post->title }}</h1>

    @if($post->image)
        <img src="{{ stored_image($post->image) }}" alt="{{ $post->title }}" class="w-full h-72 object-cover rounded-2xl mb-8">
    @endif

    @if($post->excerpt)
        <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-8 border-l-4 border-cyan-500 pl-5">{{ $post->excerpt }}</p>
    @endif

    <div class="whitespace-pre-line text-slate-700 dark:text-slate-300 leading-loose text-base space-y-4">
        {{ $post->content }}
    </div>

    @if($related->count())
        <div class="mt-16 pt-8 border-t border-slate-200 dark:border-slate-800">
            <h2 class="text-xl font-bold mb-5">Artikel lainnya</h2>
            <div class="grid sm:grid-cols-3 gap-4">
                @foreach($related as $item)
                    <a href="{{ route('blog.show', $item) }}" class="p-4 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-cyan-500 transition">
                        <p class="text-xs text-cyan-600 dark:text-cyan-400 font-bold mb-1">{{ $item->category }}</p>
                        <p class="text-sm font-bold leading-snug">{{ $item->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</article>

<footer class="py-8 text-center text-sm text-slate-500 border-t border-slate-200 dark:border-slate-800">
    © {{ date('Y') }} {{ $settings['full_name'] }} — Catatan Ngoding
</footer>

</body>
</html>

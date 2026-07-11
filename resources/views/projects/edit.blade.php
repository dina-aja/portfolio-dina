<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css'])

    <title>Edit Project</title>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center px-6 py-20">

    <div class="w-full max-w-2xl bg-[#0B1220] p-10 rounded-3xl border border-gray-800 shadow-2xl">

        <!-- Judul -->
        <h1 class="text-4xl font-bold mb-10 text-center">
            Edit
            <span class="text-cyan-400">
                Project
            </span>
        </h1>

        <!-- Error Validasi -->
        @if ($errors->any())

            <div class="bg-red-500/20 border border-red-500 text-red-300 p-4 rounded-xl mb-6">

                <ul class="list-disc pl-5 space-y-1">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Form -->
        <form action="{{ route('projects.update', $project->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>

                <label class="block mb-2 text-gray-300">
                    Judul Project
                </label>

                <input type="text"
                    name="title"
                    value="{{ old('title', $project->title) }}"
                    placeholder="Masukkan judul project"
                    class="w-full p-4 rounded-xl bg-black border border-gray-700 focus:border-cyan-400 outline-none">

            </div>

            <!-- Deskripsi -->
            <div>

                <label class="block mb-2 text-gray-300">
                    Deskripsi
                </label>

                <textarea name="description"
                    rows="5"
                    placeholder="Masukkan deskripsi project"
                    class="w-full p-4 rounded-xl bg-black border border-gray-700 focus:border-cyan-400 outline-none">{{ old('description', $project->description) }}</textarea>

            </div>

            <!-- Gambar Lama -->
            <div>

                <label class="block mb-2 text-gray-300">
                    Gambar Saat Ini
                </label>

                <img src="{{ asset('storage/' . $project->image) }}"
                    class="w-full h-56 object-cover rounded-xl border border-gray-700">

            </div>

            <!-- Upload Gambar Baru -->
            <div>

                <label class="block mb-2 text-gray-300">
                    Upload Gambar Baru
                </label>

                <input type="file"
                    name="image"
                    class="w-full p-4 rounded-xl bg-black border border-gray-700 text-gray-300 focus:border-cyan-400 outline-none file:bg-cyan-400 file:text-black file:border-0 file:px-4 file:py-2 file:rounded-lg file:mr-4">

            </div>

            <!-- Demo -->
            <div>

                <label class="block mb-2 text-gray-300">
                    Link Project
                </label>

                <input type="text"
                    name="demo"
                    value="{{ old('demo', $project->demo) }}"
                    placeholder="Masukkan link project"
                    class="w-full p-4 rounded-xl bg-black border border-gray-700 focus:border-cyan-400 outline-none">

            </div>

            <!-- Tombol -->
            <div class="flex flex-col sm:flex-row gap-4">

                <!-- Batal -->
                <a href="/dashboard"
                    class="w-full text-center border border-gray-600 text-gray-300 py-4 rounded-xl font-bold hover:bg-gray-800 duration-300">

                    Batal

                </a>

                <!-- Update -->
                <button type="submit"
                    class="w-full bg-cyan-400 text-black py-4 rounded-xl font-bold hover:scale-105 duration-300">

                    Update Project

                </button>

            </div>

        </form>

    </div>

</body>
</html>
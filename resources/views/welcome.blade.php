<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dina Portfolio</title>

    <style>

html {
    scroll-behavior: smooth;
}

/* Fade Animation */
.fade-section {

    opacity: 0;
    transform: translateY(60px);
    transition: all 1s ease;

}

.fade-section.show {

    opacity: 1;
    transform: translateY(0);

}

</style>

</head>

<body class="bg-black text-white scroll-smooth overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-black/80 backdrop-blur-md z-50 border-b border-gray-800">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl md:text-3xl font-bold text-cyan-400 tracking-wide">
                Dina.
            </h1>

<!-- Desktop Menu -->
<div class="hidden md:flex items-center gap-8 text-lg">

    <a href="#home" class="hover:text-cyan-400 duration-300">
        Beranda
    </a>

    <a href="#about" class="hover:text-cyan-400 duration-300">
        Tentang Saya
    </a>

    <a href="#projects" class="hover:text-cyan-400 duration-300">
        Proyek
    </a>

    <a href="#contact" class="hover:text-cyan-400 duration-300">
        Kontak
    </a>

</div>

            <!-- Hamburger -->
            <button id="menu-btn" class="md:hidden flex flex-col gap-1">
                <span class="w-7 h-1 bg-white rounded"></span>
                <span class="w-7 h-1 bg-white rounded"></span>
                <span class="w-7 h-1 bg-white rounded"></span>
            </button>

        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-black border-t border-gray-800 px-6 py-4 space-y-4 text-center">
            <a href="#home" class="block hover:text-cyan-400">Beranda</a>
            <a href="#about" class="block hover:text-cyan-400">Tentang Saya</a>
            <a href="#projects" class="block hover:text-cyan-400">Proyek</a>
            <a href="#contact" class="block hover:text-cyan-400">Kontak</a>
        </div>

    </nav>


<!-- Hero Section -->
<section id="home" class="min-h-screen flex items-center px-6 pt-24 fade-section">

    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-14 items-center">

        <!-- Text -->
        <div class="order-2 md:order-1 text-center md:text-left">

            <p class="text-cyan-400 text-xl mb-4 tracking-widest uppercase">
                Selamat Datang
            </p>

            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6">
                Halo, Saya
                <span class="text-cyan-400 block mt-2">
                    Dina
                </span>
            </h1>

            <h2 class="text-2xl md:text-3xl text-gray-300 mb-6">
                Front-End Developer & UI/UX Designer
            </h2>

            <p class="text-gray-400 leading-relaxed text-lg mb-10 max-w-xl mx-auto md:mx-0">
                Saya adalah Front-End Developer dan UI Designer yang memiliki semangat belajar tinggi dalam membuat website modern, responsive, dan interaktif menggunakan teknologi web terbaru.
            </p>

            <!-- Button -->
            <div class="flex flex-wrap gap-4 justify-center md:justify-start">

                <a href="#projects"
                    class="bg-cyan-400 text-black px-7 py-4 rounded-2xl font-bold hover:scale-105 hover:shadow-cyan-400/50 hover:shadow-2xl duration-300 shadow-lg shadow-cyan-400/30">

                    Proyek

                </a>

                <a href="#contact"
                    class="border border-cyan-400 px-7 py-4 rounded-2xl text-cyan-400 hover:bg-cyan-400 hover:text-black hover:shadow-cyan-400/50 hover:shadow-2xl duration-300">

                    Kontak

                </a>

            </div>

        </div>

            <!-- Foto -->
            <div class="flex justify-center order-1 md:order-2">

                <div class="relative">

                    <div class="absolute inset-0 bg-cyan-400 blur-3xl opacity-30 rounded-full animate-pulse"></div>

                    <img src="{{ asset('images/dina.jpg') }}"
                        class="relative w-72 h-72 md:w-105 md:h-105 object-cover rounded-full border-4 border-cyan-400 shadow-2xl">

                </div>

        </div>

    </div>

</section>


<!-- About -->
<section id="about" class="py-28 px-6 bg-[#020817] fade-section">

    <div class="max-w-7xl mx-auto">

        <!-- Judul -->
        <h2 class="text-5xl md:text-6xl font-extrabold text-center mb-20">
            Tentang
            <span class="text-cyan-400">
                Saya
            </span>
        </h2>

        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <!-- Kiri -->
            <div class="relative">

                <!-- Card -->
                <div class="relative bg-cyan-500 rounded-[35px] h-130 flex items-center justify-center overflow-hidden">

                    <!-- Foto -->
                    <img src="{{ asset('images/DINA 2.jpg') }}"
                        class="w-full h-full object-cover">

                </div>

            </div>


            <!-- Kanan -->
            <div>

                <h3 class="text-3xl md:text-4xl font-bold leading-snug mb-8">
                    Front-End Developer & Designer 
                </h3>

                <p class="text-gray-400 text-lg leading-relaxed mb-10">
                    Saya adalah siswi jurusan PPLG yang aktif mengembangkan kemampuan dalam pembuatan website modern menggunakan Laravel dan Tailwind CSS. Saya juga tertarik pada desain UI/UX dan teknologi web modern.
                </p>


                <!-- Info Box -->
                <div class="grid sm:grid-cols-2 gap-5 mb-10">

                    <!-- Nama -->
                    <div class="bg-[#0B1220] border border-gray-800 rounded-2xl p-5">

                        <p class="text-gray-400 text-sm mb-2">
                            NAMA
                        </p>

                        <h4 class="font-semibold text-lg">
                            Dina
                        </h4>

                    </div>

                    <!-- Email -->
                    <div class="bg-[#0B1220] border border-gray-800 rounded-2xl p-5">

                        <p class="text-gray-400 text-sm mb-2">
                            EMAIL
                        </p>

                        <h4 class="font-semibold text-lg break-all">
                            dinadinaa639@gmail.com
                        </h4>

                    </div>

                    <!-- Telepon -->
                    <div class="bg-[#0B1220] border border-gray-800 rounded-2xl p-5">

                        <p class="text-gray-400 text-sm mb-2">
                            TELEPON
                        </p>

                        <h4 class="font-semibold text-lg">
                            +62 857-5171-4154
                        </h4>

                    </div>

                    <!-- Instagram -->
                    <div class="bg-[#0B1220] border border-gray-800 rounded-2xl p-5">

                        <p class="text-gray-400 text-sm mb-2">
                            Instagram
                        </p>

                        <h4 class="font-semibold text-lg">
                            @ddina597
                        </h4>

                    </div>

                    <!-- Usia -->
                    <div class="bg-[#0B1220] border border-gray-800 rounded-2xl p-5">

                        <p class="text-gray-400 text-sm mb-2">
                            Usia
                        </p>

                        <h4 class="font-semibold text-lg">
                            17 Tahun
                        </h4>

                    </div>

                    <!-- Lokasi -->
                    <div class="bg-[#0B1220] border border-gray-800 rounded-2xl p-5">

                        <p class="text-gray-400 text-sm mb-2">
                            LOKASI
                        </p>

                        <h4 class="font-semibold text-lg">
                            Banjarmasin
                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Projects -->
<section id="projects" class="py-28 px-6 fade-section">

<div class="relative mb-16">

<!-- Judul Tengah -->
<div class="text-center">

    <h2 class="text-5xl font-bold">
        Proyek
        <span class="text-cyan-400">
            Saya
        </span>
    </h2>

    <p class="text-gray-400 mt-4">
        Beberapa project website yang pernah saya buat.
    </p>

</div>

</div>

        <!-- Card Project -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($projects as $project)

            <div class="bg-gray-950 border border-gray-800 rounded-[10px] overflow-hidden hover:-translate-y-3 hover:border-cyan-400 duration-300 shadow-xl">

                <!-- Gambar -->
                <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-56 object-cover">

                <div class="p-7">

                    <!-- Judul -->
                    <h3 class="text-2xl font-bold mb-4">
                        {{ $project->title }}
                    </h3>

                    <!-- Deskripsi -->
                    <p class="text-gray-400 leading-relaxed mb-6">
                        {{ $project->description }}
                    </p>

                    <!-- Button -->
                    <div class="flex flex-wrap gap-3">

                        <!-- Demo -->
                        <a href="{{ $project->demo }}"
                            target="_blank"
                            class="bg-cyan-400 text-black px-5 py-3 rounded-xl font-semibold hover:scale-105 duration-300">

                            Lihat Project

                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>


<!-- Contact -->
<section id="contact" class="py-28 px-6 bg-linear-to-b from-gray-950 to-black fade-section">

    <div class="max-w-7xl mx-auto">

        <!-- Judul -->
        <div class="text-center mb-20">

            <h2 class="text-5xl md:text-6xl font-bold mb-6">
                Kontak
                <span class="text-cyan-400">
                    Saya
                </span>
            </h2>

            <p class="text-gray-400 text-lg">
                Mari bekerja sama dan membuat project website modern bersama.
            </p>

        </div>


        <!-- Card Contact -->
        <div class="grid md:grid-cols-2 gap-5">

            <!-- Instagram -->
            <a href="https://instagram.com/ddina597" target="_blank"
                class="bg-[#0B1220] border border-gray-800 p-6 rounded-[25px] hover:-translate-y-2 hover:border-cyan-400 duration-300 relative overflow-hidden group">

                <!-- Icon -->
                <div class="w-16 h-16 rounded-2xl border border-gray-700 flex items-center justify-center mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-cyan-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="1.5"/>
                        <path stroke-width="1.5" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>

                    </svg>

                </div>

                <!-- Arrow -->
                <span class="absolute top-6 right-6 text-3xl text-gray-600 group-hover:text-cyan-400 duration-300">
                    ↗
                </span>

                <h3 class="text-3xl font-bold mb-3">
                    Instagram
                </h3>

                <p class="uppercase tracking-[3px] text-gray-500 mb-4 text-xs">
                    Ikuti update harian saya
                </p>

                <p class="text-lg text-gray-300">
                    @dina597
                </p>

            </a>


            <!-- WhatsApp -->
            <a href="https://wa.me/6285751714154" target="_blank"
                class="bg-[#0B1220] border border-gray-800 p-6 rounded-[25px] hover:-translate-y-2 hover:border-cyan-400 duration-300 relative overflow-hidden group">

                <!-- Icon -->
                <div class="w-16 h-16 rounded-2xl border border-gray-700 flex items-center justify-center mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-cyan-400"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path d="M20.52 3.48A11.79 11.79 0 0012.04 0C5.5 0 .18 5.3.18 11.82c0 2.08.55 4.1 1.6 5.87L0 24l6.5-1.7a11.83 11.83 0 005.54 1.4h.01c6.53 0 11.85-5.3 11.85-11.82 0-3.15-1.23-6.11-3.38-8.4z"/>

                    </svg>

                </div>

                <!-- Arrow -->
                <span class="absolute top-6 right-6 text-3xl text-gray-600 group-hover:text-cyan-400 duration-300">
                    ↗
                </span>

                <h3 class="text-3xl font-bold mb-3">
                    WhatsApp
                </h3>

                <p class="uppercase tracking-[3px] text-gray-500 mb-4 text-xs">
                    Hubungi saya secara langsung
                </p>

                <p class="text-lg text-gray-300">
                    +62 857-5171-4154
                </p>

            </a>


            <!-- Github -->
            <a href="https://github.com/dina-aja" target="_blank"
                class="bg-[#0B1220] border border-gray-800 p-6 rounded-[25px] hover:-translate-y-2 hover:border-cyan-400 duration-300 relative overflow-hidden group">

                <!-- Icon -->
                <div class="w-16 h-16 rounded-2xl border border-gray-700 flex items-center justify-center mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-cyan-400"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.58 2 12.24c0 4.52 2.87 8.35 6.84 9.7"/>

                    </svg>

                </div>

                <!-- Arrow -->
                <span class="absolute top-6 right-6 text-3xl text-gray-600 group-hover:text-cyan-400 duration-300">
                    ↗
                </span>

                <h3 class="text-3xl font-bold mb-3">
                    Github
                </h3>

                <p class="uppercase tracking-[3px] text-gray-500 mb-4 text-xs">
                    Lihat repository project saya
                </p>

                <p class="text-lg text-gray-300">
                    Dina
                </p>

            </a>


            <!-- Email -->
            <a href="mailto:dinadinaa639@gmail.com" target="_blank"
                class="bg-[#0B1220] border border-gray-800 p-6 rounded-[25px] hover:-translate-y-2 hover:border-cyan-400 duration-300 relative overflow-hidden group">

                <!-- Icon -->
                <div class="w-16 h-16 rounded-2xl border border-gray-700 flex items-center justify-center mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-cyan-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8m-18 8h18V8H3v8z" />

                    </svg>

                </div>

                <!-- Arrow -->
                <span class="absolute top-6 right-6 text-3xl text-gray-600 group-hover:text-cyan-400 duration-300">
                    ↗
                </span>

                <h3 class="text-3xl font-bold mb-3">
                    Email
                </h3>

                <p class="uppercase tracking-[3px] text-gray-500 mb-4 text-xs">
                    Hubungi saya melalui email
                </p>

                <p class="text-lg text-gray-300 break-all">
                    dinadinaa639@gmail.com
                </p>

            </a>

        </div>

    </div>

</section>


    <!-- Footer -->
    <footer class="py-8 border-t border-gray-800 text-center text-gray-500">

© 2026 Dina Portfolio. All Rights Reserved.

<div class="mt-3">
    <a href="/login"
    class="text-xs text-gray-700 hover:text-cyan-400 duration-300">

        Admin

    </a>
</div>

</footer>


    <!-- Script Hamburger -->
    <script>

        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

// Auto close mobile menu
document.querySelectorAll('#mobile-menu a').forEach(link => {

link.addEventListener('click', () => {

    mobileMenu.classList.add('hidden');

});

});

// Fade Animation Repeat
const fadeSections = document.querySelectorAll('.fade-section');

const observer = new IntersectionObserver((entries) => {

    entries.forEach((entry) => {

        if (entry.isIntersecting) {

            entry.target.classList.add('show');

        } else {

            entry.target.classList.remove('show');

        }

    });

}, {
    threshold: 0.15
});

fadeSections.forEach((section) => {

    observer.observe(section);

});

    </script>

</body>
</html>

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pengaturan konten profil (diedit dari Dashboard Admin)
    |--------------------------------------------------------------------------
    */
    'settings' => [
        'full_name' => ['label' => 'Nama Lengkap', 'type' => 'text', 'group' => 'Profil', 'default' => 'Dina'],
        'nickname' => ['label' => 'Nama Panggilan', 'type' => 'text', 'group' => 'Profil', 'default' => 'Dina'],
        'class' => ['label' => 'Kelas', 'type' => 'text', 'group' => 'Profil', 'default' => 'XII PPLG 1'],
        'competency' => ['label' => 'Kompetensi Keahlian', 'type' => 'text', 'group' => 'Profil', 'default' => 'Pengembangan Perangkat Lunak dan Gim (PPLG)'],
        'school' => ['label' => 'Sekolah', 'type' => 'text', 'group' => 'Profil', 'default' => 'SMK Negeri 2 Banjarmasin'],
        'location' => ['label' => 'Lokasi', 'type' => 'text', 'group' => 'Profil', 'default' => 'Banjarmasin, Kalimantan Selatan'],
        'avatar' => ['label' => 'Foto Profil (path di public/)', 'type' => 'text', 'group' => 'Profil', 'default' => 'images/dina.jpg'],
        'hero_badge' => ['label' => 'Teks Sapaan Beranda', 'type' => 'text', 'group' => 'Beranda', 'default' => 'Selamat Datang di Portfolio Saya'],
        'tagline' => ['label' => 'Tagline / Role', 'type' => 'text', 'group' => 'Beranda', 'default' => 'Front-End Developer & UI/UX Designer'],
        'hero_description' => ['label' => 'Deskripsi Singkat / Personal Branding', 'type' => 'textarea', 'group' => 'Beranda', 'default' => 'Saya adalah siswi PPLG yang antusias membangun website modern, responsif, dan mudah digunakan. Saya suka belajar teknologi baru dan terus berlatih lewat proyek nyata.'],
        'about_biodata' => ['label' => 'Biodata Singkat', 'type' => 'textarea', 'group' => 'Tentang Saya', 'default' => 'Saya adalah Dina, siswa kelas XII PPLG 1 di SMK Negeri 2 Banjarmasin, jurusan Pengembangan Perangkat Lunak dan Gim (PPLG). Minat saya pada dunia pemrograman terasah lewat proyek aplikasi web yang saya bangun dengan HTML, CSS, JavaScript, PHP, MySQL, dan Laravel. Saya senang mempelajari hal baru, mencoba teknologi yang belum pernah dipakai, dan menjadikan setiap proyek sebagai sarana mengasah keterampilan sekaligus menambah pengalaman. Saya berdomisili di Banjarmasin, Kalimantan Selatan, dan dapat dihubungi melalui dinadinaa639@gmail.com.'],
        'education' => ['label' => 'Riwayat Pendidikan', 'type' => 'textarea', 'group' => 'Tentang Saya', 'default' => "SDN Kuin Utara 7 Banjarmasin\n2015 – 2021\n\nSMPN 5 Banjarmasin\n2021 – 2024\n\nSMK Negeri 2 Banjarmasin\nPengembangan Perangkat Lunak dan Gim (PPLG)\n2024 – 2027"],
        'interests' => ['label' => 'Minat & Bidang Teknologi', 'type' => 'textarea', 'group' => 'Tentang Saya', 'default' => "Front-End Development (HTML, CSS, JavaScript)\nLaravel & Tailwind CSS\nUI/UX Design dengan Figma\nDatabase & API"],
        'organization' => ['label' => 'Pengalaman Organisasi / Kepanitiaan', 'type' => 'textarea', 'group' => 'Tentang Saya', 'default' => "Anggota OSIS SMK Negeri 1 Banjarmasin\nPanitia Hari Ulang Tahun Sekolah"],
        'plk' => ['label' => 'Pengalaman PLK', 'type' => 'textarea', 'group' => 'Tentang Saya', 'default' => "Praktik Lapangan Kerja di bidang pengembangan web, membantu pembuatan dan pemeliharaan website instansi."],
        'career_goal' => ['label' => 'Cita-cita / Tujuan Karir', 'type' => 'textarea', 'group' => 'Tentang Saya', 'default' => 'Menjadi Full-Stack Developer yang mampu membangun produk digital bermanfaat dan terus berkontribusi di industri teknologi.'],
        'email' => ['label' => 'Email', 'type' => 'email', 'group' => 'Kontak', 'default' => 'dinadinaa639@gmail.com'],
        'phone' => ['label' => 'Nomor Telepon', 'type' => 'text', 'group' => 'Kontak', 'default' => '+62 857-5171-4154'],
        'instagram' => ['label' => 'Link Instagram', 'type' => 'url', 'group' => 'Kontak', 'default' => 'https://instagram.com/ddina597'],
        'github' => ['label' => 'Link GitHub', 'type' => 'url', 'group' => 'Kontak', 'default' => 'https://github.com/dina-aja'],
        'cv_url' => ['label' => 'Link CV / Resume (opsional)', 'type' => 'url', 'group' => 'Kontak', 'default' => ''],
    ],

    /*
    |--------------------------------------------------------------------------
    | Konfigurasi CRUD admin (dipakai controller generik & view generik)
    |--------------------------------------------------------------------------
    */
    'crud' => [
        'projects' => [
            'title' => 'Proyek',
            'singular' => 'Proyek',
            'model' => \App\Models\Project::class,
            'route' => 'projects',
            'description' => 'Kelola portofolio proyek beserta detail, dokumentasi, dan feedback.',
            'columns' => ['title', 'category', 'demo', 'is_featured'],
            'fields' => [
                'title' => ['label' => 'Nama Proyek', 'type' => 'text', 'rules' => 'required|max:255'],
                'category' => ['label' => 'Kategori', 'type' => 'text', 'rules' => 'nullable|max:100'],
                'description' => ['label' => 'Deskripsi Proyek', 'type' => 'textarea', 'rules' => 'required'],
                'problem' => ['label' => 'Permasalahan yang Ingin Diselesaikan', 'type' => 'textarea', 'rules' => 'nullable'],
                'goal' => ['label' => 'Tujuan Dibuatnya Proyek', 'type' => 'textarea', 'rules' => 'nullable'],
                'technologies' => ['label' => 'Teknologi yang Digunakan (pisahkan dengan koma)', 'type' => 'text', 'rules' => 'nullable'],
                'role' => ['label' => 'Peran dalam Proyek', 'type' => 'text', 'rules' => 'nullable|max:150'],
                'features' => ['label' => 'Fitur-fitur Proyek (pisahkan dengan koma atau baris baru)', 'type' => 'textarea', 'rules' => 'nullable'],
                'story' => ['label' => 'Cerita Proses Pembuatan', 'type' => 'textarea', 'rules' => 'nullable'],
                'detail' => ['label' => 'Detail Proyek', 'type' => 'textarea', 'rules' => 'nullable'],
                'image' => ['label' => 'Gambar / Screenshot Aplikasi', 'type' => 'image', 'rules' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'],
                'demo' => ['label' => 'Link Demo', 'type' => 'url', 'rules' => 'nullable|url'],
                'github' => ['label' => 'Link Source Code GitHub', 'type' => 'url', 'rules' => 'nullable|url'],
                'documentation' => ['label' => 'Link Dokumentasi Proses Pekerjaan', 'type' => 'url', 'rules' => 'nullable|url'],
                'feedback' => ['label' => 'Feedback User', 'type' => 'textarea', 'rules' => 'nullable'],
                'is_featured' => ['label' => 'Tampilkan sebagai Proyek Unggulan', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
            ],
        ],
        'certificates' => [
            'title' => 'Sertifikat & Prestasi',
            'singular' => 'Sertifikat',
            'model' => \App\Models\Certificate::class,
            'route' => 'certificates',
            'description' => 'Tambah atau hapus sertifikat dan prestasi beserta dokumentasinya.',
            'columns' => ['title', 'issuer', 'year', 'category'],
            'fields' => [
                'title' => ['label' => 'Judul Sertifikat / Prestasi', 'type' => 'text', 'rules' => 'required|max:255'],
                'category' => ['label' => 'Kategori', 'type' => 'select', 'options' => ['Sertifikat' => 'Sertifikat', 'Prestasi' => 'Prestasi'], 'rules' => 'required'],
                'issuer' => ['label' => 'Penerbit / Penyelenggara', 'type' => 'text', 'rules' => 'nullable|max:255'],
                'year' => ['label' => 'Tahun', 'type' => 'text', 'rules' => 'nullable|max:20'],
                'description' => ['label' => 'Keterangan', 'type' => 'textarea', 'rules' => 'nullable'],
                'image' => ['label' => 'Dokumentasi (foto sertifikat)', 'type' => 'image', 'rules' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'],
            ],
        ],
        'experiences' => [
            'title' => 'Pengalaman',
            'singular' => 'Pengalaman',
            'model' => \App\Models\Experience::class,
            'route' => 'experiences',
            'description' => 'Kelola pengalaman PLK, organisasi, dan lomba.',
            'columns' => ['type', 'title', 'organization', 'period'],
            'fields' => [
                'type' => ['label' => 'Jenis Pengalaman', 'type' => 'select', 'options' => ['PLK' => 'PLK', 'Organisasi' => 'Organisasi', 'Lomba' => 'Lomba'], 'rules' => 'required'],
                'title' => ['label' => 'Judul / Posisi', 'type' => 'text', 'rules' => 'required|max:255'],
                'organization' => ['label' => 'Instansi / Penyelenggara', 'type' => 'text', 'rules' => 'nullable|max:255'],
                'period' => ['label' => 'Periode', 'type' => 'text', 'rules' => 'nullable|max:100'],
                'description' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'nullable'],
            ],
        ],
        'skills' => [
            'title' => 'Keahlian / Skills',
            'singular' => 'Keahlian',
            'model' => \App\Models\Skill::class,
            'route' => 'skills',
            'description' => 'Atur kemampuan teknis (hard skill) dan non-teknis (soft skill) beserta persentasenya.',
            'columns' => ['name', 'category', 'percentage'],
            'fields' => [
                'name' => ['label' => 'Nama Keahlian', 'type' => 'text', 'rules' => 'required|max:100'],
                'category' => ['label' => 'Kategori', 'type' => 'select', 'options' => ['Hard Skill' => 'Hard Skill', 'Soft Skill' => 'Soft Skill'], 'rules' => 'required'],
                'percentage' => ['label' => 'Tingkat Kemampuan (%)', 'type' => 'number', 'rules' => 'required|integer|min:1|max:100'],
                'icon' => ['label' => 'Emoji / Ikon (opsional)', 'type' => 'text', 'rules' => 'nullable|max:20'],
            ],
        ],
        'testimonials' => [
            'title' => 'Testimoni',
            'singular' => 'Testimoni',
            'model' => \App\Models\Testimonial::class,
            'route' => 'testimonials',
            'description' => 'Kelola testimoni guru pembimbing, teman, pengguna, dan tempat PLK. Testimoni dari pengunjung menunggu persetujuan sebelum ditampilkan di beranda.',
            'columns' => ['name', 'category', 'role', 'rating', 'is_approved'],
            'approvable' => true,
            'fields' => [
                'name' => ['label' => 'Nama Pemberi Testimoni', 'type' => 'text', 'rules' => 'required|max:100'],
                'category' => ['label' => 'Kategori', 'type' => 'select', 'options' => ['Guru Pembimbing' => 'Guru Pembimbing', 'Teman' => 'Teman', 'Pengguna' => 'Pengguna', 'Tempat PLK' => 'Tempat PLK', 'Lainnya' => 'Lainnya'], 'rules' => 'required'],
                'role' => ['label' => 'Peran / Jabatan', 'type' => 'text', 'rules' => 'nullable|max:150'],
                'rating' => ['label' => 'Penilaian (bintang)', 'type' => 'select', 'options' => ['5' => '★★★★★ (5)', '4' => '★★★★ (4)', '3' => '★★★ (3)', '2' => '★★ (2)', '1' => '★ (1)'], 'rules' => 'required|integer|min:1|max:5'],
                'message' => ['label' => 'Isi Testimoni', 'type' => 'textarea', 'rules' => 'required'],
                'avatar' => ['label' => 'Foto (path di public/, opsional)', 'type' => 'text', 'rules' => 'nullable|max:255'],
            ],
        ],
        'blog-posts' => [
            'title' => 'Blog Pengembang',
            'singular' => 'Artikel',
            'model' => \App\Models\BlogPost::class,
            'route' => 'blog-posts',
            'description' => 'Tulis artikel, catatan ngoding, tutorial singkat, atau dokumentasi solusi masalah.',
            'columns' => ['title', 'category', 'published_at'],
            'fields' => [
                'title' => ['label' => 'Judul Artikel', 'type' => 'text', 'rules' => 'required|max:255'],
                'category' => ['label' => 'Kategori', 'type' => 'select', 'options' => ['Catatan Ngoding' => 'Catatan Ngoding', 'Tutorial' => 'Tutorial', 'Solusi Masalah' => 'Solusi Masalah', 'Pengalaman' => 'Pengalaman'], 'rules' => 'required'],
                'excerpt' => ['label' => 'Ringkasan', 'type' => 'textarea', 'rules' => 'nullable'],
                'content' => ['label' => 'Isi Artikel', 'type' => 'textarea', 'rules' => 'required'],
                'image' => ['label' => 'Gambar Cover', 'type' => 'image', 'rules' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'],
                'published_at' => ['label' => 'Tanggal Publikasi', 'type' => 'datetime-local', 'rules' => 'nullable|date'],
            ],
        ],
    ],
];

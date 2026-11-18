<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAdmin();
        $this->seedSettings();
        $this->seedSkills();
        $this->seedProjects();
        $this->seedCertificates();
        $this->seedExperiences();
        $this->seedTestimonials();
        $this->seedBlogPosts();
        $this->seedMessages();
    }

    private function seedAdmin(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Dina',
                'password' => Hash::make('admin123'),
            ]
        );
    }

    private function seedSettings(): void
    {
        foreach (config('portfolio.settings') as $key => $definition) {
            Setting::firstOrCreate(
                ['key' => $key],
                ['value' => $definition['default'] ?? '']
            );
        }
    }

    private function seedSkills(): void
    {
        $skills = [
            ['HTML & CSS', 'Hard Skill', 95, '💻'],
            ['JavaScript', 'Hard Skill', 85, '🟨'],
            ['Tailwind CSS', 'Hard Skill', 90, '🎨'],
            ['Laravel', 'Hard Skill', 80, '🐘'],
            ['MySQL', 'Hard Skill', 75, '🗄️'],
            ['Git & GitHub', 'Hard Skill', 78, '🔧'],
            ['Figma / UI Design', 'Hard Skill', 85, '✏️'],
            ['Komunikasi', 'Soft Skill', 90, '💬'],
            ['Kerja Tim', 'Soft Skill', 92, '🤝'],
            ['Problem Solving', 'Soft Skill', 88, '🧠'],
            ['Manajemen Waktu', 'Soft Skill', 85, '⏰'],
            ['Tanggung Jawab', 'Soft Skill', 95, '🎯'],
        ];

        foreach ($skills as [$name, $category, $percentage, $icon]) {
            Skill::firstOrCreate(
                ['name' => $name],
                ['category' => $category, 'percentage' => $percentage, 'icon' => $icon]
            );
        }
    }

    private function seedProjects(): void
    {
        $projects = [
            [
                'title' => 'Portfolio Pribadi Dina',
                'category' => 'Website',
                'description' => 'Website portfolio responsif untuk menampilkan profil, proyek, sertifikat, pengalaman, dan testimoni dalam satu halaman yang mudah dinavigasi.',
                'problem' => 'Informasi portofolio tersebar di berbagai platform sehingga sulit dilihat secara menyeluruh oleh calon pemberi kerja.',
                'goal' => 'Menyatukan seluruh informasi pribadi dan karya ke dalam satu website yang rapi, responsif, dan mudah diperbarui.',
                'technologies' => 'Laravel, Tailwind CSS, JavaScript, MySQL, Vite',
                'role' => 'Front-End Developer & UI Designer',
                'features' => "Halaman beranda dengan profil dan personal branding\nHalaman tentang saya, skills, proyek, sertifikat, dan pengalaman\nForm kesan dan pesan yang tersimpan di database\nMode gelap dan terang\nDashboard admin untuk mengelola konten",
                'story' => 'Saya mulai dengan membuat wireframe sederhana, lalu membangun struktur data agar semua konten bisa diubah dari dashboard tanpa menyunting kode. Tantangan terbesar adalah membuat tampilan tetap nyaman di layar kecil.',
                'detail' => 'Proyek ini dibangun dengan pendekatan komponen dan konfigurasi berbasis database, sehingga penambahan proyek baru cukup dilakukan lewat halaman admin.',
                'image' => 'projects/YilA8QAVE5rd8e3Wuq3dfZWrxQobda3cRaC4MI3N.jpg',
                'demo' => 'https://portofolio-dina.test',
                'github' => 'https://github.com/dina-aja',
                'documentation' => '',
                'feedback' => 'Tampilannya rapi dan mudah digunakan, kontennya juga lengkap.',
                'is_featured' => true,
            ],
            [
                'title' => 'Sistem Informasi Perpustakaan Sekolah',
                'category' => 'Web Application',
                'description' => 'Aplikasi web untuk mengelola data buku, peminjaman, dan pengembalian secara digital di perpustakaan sekolah.',
                'problem' => 'Pencatatan peminjaman buku masih menggunakan buku tulis sehingga sering terjadi selisih data dan keterlambatan pengembalian.',
                'goal' => 'Membantu petugas perpustakaan mengelola data secara cepat dan akurat serta memudahkan siswa mengecek ketersediaan buku.',
                'technologies' => 'PHP, Laravel, Bootstrap, MySQL',
                'role' => 'Backend Developer',
                'features' => "Manajemen data buku\nPeminjaman dan pengembalian buku\nPencarian buku berdasarkan judul\nLaporan keterlambatan",
                'story' => 'Saya belajar merancang relasi tabel antara buku, siswa, dan transaksi peminjaman. Proses debugging query menjadi pengalaman berharga dalam menyelesaikan masalah.',
                'detail' => 'Fokus utama proyek ini adalah konsistensi data transaksi dan kemudahan penggunaan bagi petugas perpustakaan.',
                'image' => 'projects/VTbA6jyDS9iLlhxSNO41UQW8CfmaFa1A2ELowzyl.jpg',
                'demo' => 'https://example.com/perpustakaan',
                'github' => 'https://github.com/dina-aja/perpustakaan-sekolah',
                'documentation' => '',
                'feedback' => 'Petugas perpustakaan merasa lebih terbantu dengan pencarian buku yang cepat.',
                'is_featured' => false,
            ],
            [
                'title' => 'Landing Page Produk Lokal',
                'category' => 'UI/UX Design',
                'description' => 'Halaman promosi produk lokal dengan desain modern dan optimasi untuk tampilan mobile.',
                'problem' => 'UMKM lokal belum memiliki halaman promosi yang profesional untuk menampilkan produknya.',
                'goal' => 'Meningkatkan daya tarik visual dan kemudahan calon pembeli dalam melihat informasi produk.',
                'technologies' => 'HTML, CSS, JavaScript, Figma',
                'role' => 'UI/UX Designer & Front-End Developer',
                'features' => "Desain responsif\nGaleri produk\nTombol kontak WhatsApp\nAnimasi scroll sederhana",
                'story' => 'Saya membuat moodboard terlebih dahulu, lalu prototipe di Figma sebelum masuk ke tahap coding agar arah desain lebih jelas.',
                'detail' => 'Proyek ini menekankan pada hierarchy visual dan call-to-action yang jelas.',
                'image' => 'projects/QGXZIuEzRRAzrCK3LXv08SRmWjdogPaHpjm5tGmb.jpg',
                'demo' => 'https://example.com/produk-lokal',
                'github' => 'https://github.com/dina-aja/landing-page-produk',
                'documentation' => '',
                'feedback' => 'Desainnya menarik dan informasinya mudah dibaca.',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(['title' => $project['title']], $project);
        }
    }

    private function seedCertificates(): void
    {
        $certificates = [
            ['Sertifikat Dasar Web Development', 'Dicoding Indonesia', '2025', 'Sertifikat', 'Menyelesaikan kursus dasar pengembangan web front-end.'],
            ['Juara 1 Lomba Pembuatan Website Sekolah', 'SMK Negeri 1 Banjarmasin', '2025', 'Prestasi', 'Meraih juara pertama dalam lomba pembuatan website tingkat sekolah.'],
            ['Sertifikat UI/UX Design Fundamentals', 'Coursera', '2024', 'Sertifikat', 'Memahami dasar-dasar desain antarmuka dan pengalaman pengguna.'],
            ['Sertifikat Praktik Lapangan Kerja', 'PT Banjarmasin Digital', '2025', 'Sertifikat', 'Berhasil menyelesaikan program PLK di bidang pengembangan web.'],
        ];

        foreach ($certificates as [$title, $issuer, $year, $category, $description]) {
            Certificate::firstOrCreate(
                ['title' => $title],
                compact('issuer', 'year', 'category', 'description')
            );
        }
    }

    private function seedExperiences(): void
    {
        $experiences = [
            ['PLK', 'Web Developer Intern', 'PT Banjarmasin Digital', 'Jan - Jun 2025', 'Membantu tim mengembangkan dan memelihara website company profile, serta memperbaiki tampilan responsif.'],
            ['Organisasi', 'Anggota OSIS', 'SMK Negeri 1 Banjarmasin', '2023 - 2024', 'Berpartisipasi dalam kegiatan sekolah dan menjadi panitia acara hari ulang tahun sekolah.'],
            ['Lomba', 'Juara 1 Lomba Website Sekolah', 'SMK Negeri 1 Banjarmasin', '2025', 'Membuat website sekolah sebagai karya lomba dan mempresentasikannya di depan juri.'],
            ['Organisasi', 'Panitia Kegiatan Campus Expo', 'SMK Negeri 1 Banjarmasin', '2024', 'Bertanggung jawab atas dokumentasi dan publikasi kegiatan.'],
        ];

        foreach ($experiences as [$type, $title, $organization, $period, $description]) {
            Experience::firstOrCreate(
                ['title' => $title, 'type' => $type],
                compact('organization', 'period', 'description')
            );
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            ['Ibu Sari', 'Guru Pembimbing', 'Guru Pembimbing', 'Dina adalah siswi yang rajin, teliti, dan selalu ingin tahu. Kemampuan dalam menyelesaikan masalah teknis terus berkembang setiap proyek.'],
            ['Rani', 'Teman Sekelas', 'Teman', 'Dina orangnya sabar dan senang berbagi. Saat kerja kelompok, dia selalu memastikan semua ide terdengar dan hasilnya rapi.'],
            ['Andi', 'Pengguna Website', 'Pengguna', 'Website portofolionya mudah dinavigasi dan informasinya lengkap. Saya jadi lebih mudah mengenali karya-karyanya.'],
            ['Pak Budi', 'Supervisor PLK', 'Tempat PLK', 'Selama PLK, Dina menunjukkan initiative yang tinggi dan cepat beradaptasi dengan sistem yang ada di perusahaan.'],
        ];

        foreach ($testimonials as [$name, $role, $category, $message]) {
            Testimonial::firstOrCreate(
                ['name' => $name],
                compact('role', 'category', 'message')
            );
        }
    }

    private function seedBlogPosts(): void
    {
        $posts = [
            [
                'title' => 'Belajar Tailwind CSS dalam 7 Hari',
                'category' => 'Tutorial',
                'excerpt' => 'Catatan singkat perjalanan saya mempelajari utility-first CSS framework dan tips yang membantu saya cepat nyaman.',
                'content' => "Hari pertama saya hanya bermain dengan utility class seperti flex, p-4, dan text-center.\n\nHari kedua sampai keempat saya fokus membuat layout responsif dengan breakpoint md dan lg. Kuncinya adalah membiasakan membaca class sebagai satu kesatuan, bukan menghafal semuanya sekaligus.\n\nHari kelima saya mencoba dark mode. Ternyata cukup menambahkan varian dark dan mengelola kelas pada elemen html.\n\nHari keenam dan ketujuh saya membuat satu halaman portfolio kecil sebagai latihan. Hasilnya lebih rapi dibanding menulis CSS dari nol.",
            ],
            [
                'title' => 'Catatan Ngoding: Mengapa Tombol Saya Tidak Berfungsi?',
                'category' => 'Solusi Masalah',
                'excerpt' => 'Pengalaman debug sederhana yang mengajarkan saya untuk selalu mengecek urutan script dan event listener.',
                'content' => "Suatu hari tombol menu hamburger saya tidak merespons saat diklik. Kode sudah terlihat benar, tetapi console menyatakan elemen bernilai null.\n\nTernyata script dijalankan sebelum elemen selesai dibuat. Solusinya sederhana: pindahkan script ke bawah body atau bungkus dengan DOMContentLoaded.\n\nPelajaran yang saya ambil: selalu cek console terlebih dahulu, lalu pastikan elemen benar-benar ada sebelum menambahkan event listener.",
            ],
            [
                'title' => 'Pengalaman PLK: dari Magang sampai Bikin Fitur',
                'category' => 'Pengalaman',
                'excerpt' => 'Cerita singkat selama praktik lapangan kerja dan bagaimana saya berkontribusi pada proyek website company profile.',
                'content' => "Pada minggu pertama saya banyak membaca kode yang sudah ada dan mengikuti alur kerja tim.\n\nDi minggu kedua saya diberi tugas kecil: memperbaiki tampilan tabel agar tetap enak dibaca di layar ponsel. Ternyata perubahan kecil bisa berdampak besar bagi pengguna.\n\nDi akhir PLK saya diajak membuat satu fitur baru dan diminta mendokumentasikan prosesnya. Dari situ saya sadar bahwa komunikasi tim sama pentingnya dengan kemampuan teknis.",
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($post['title'])],
                $post + ['published_at' => now()->subDays(rand(1, 60))]
            );
        }
    }

    private function seedMessages(): void
    {
        Message::firstOrCreate(
            ['email' => 'pengunjung@example.com'],
            [
                'name' => 'Pengunjung',
                'subject' => 'Portfolio yang menarik',
                'message' => 'Halo Dina, portofolionya sangat rapi dan mudah dibaca. Semangat terus berkarya!',
                'is_read' => false,
            ]
        );
    }
}

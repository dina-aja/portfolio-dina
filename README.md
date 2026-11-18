# Portfolio Digital Dina

Website portfolio siswa berbasis **Laravel + Tailwind CSS 4** dengan dashboard admin (CMS) untuk mengelola seluruh konten tanpa mengubah kode.

## Fitur

### Halaman Publik (`/`)
- Beranda: foto profil, nama lengkap, kelas & kompetensi keahlian, personal branding, keahlian utama, tombol Lihat Portfolio / Lihat CV / Hubungi Saya
- Tentang Saya: narasi biodata yang menyatu dengan data profil (nama, kelas, kompetensi, sekolah, lokasi, email), lalu 2 kotak di bawahnya — riwayat pendidikan dan cita-cita/karir
- Keahlian: hard skill & soft skill dengan persentase
- Galeri proyek: pencarian, filter kategori, preview & detail proyek (masalah, tujuan, teknologi, peran, fitur, cerita proses, dokumentasi, feedback, demo, GitHub)
- Sertifikat & prestasi dengan dokumentasi gambar (lightbox)
- Pengalaman: PLK, organisasi, lomba (tab filter)
- CV digital (`/cv`) — bisa dicetak/disimpan sebagai PDF
- Testimoni: guru pembimbing, teman, pengguna, tempat PLK (tab filter)
- Blog pengembang: catatan ngoding, tutorial, solusi masalah, pengalaman (`/blog/{slug}`)
- Form kesan & pesan yang tersimpan ke database
- Dark/light mode, animasi reveal & page-enter, navigasi mobile, back-to-top, responsif

### Dashboard Admin (`/dashboard`)
- Login / logout
- Kelola profil & seluruh teks website (Profil & Konten)
- CRUD: proyek, sertifikat, pengalaman, keahlian, testimoni, artikel blog
- Upload gambar proyek & dokumentasi sertifikat
- Kelola pesan masuk (baca, tandai dibaca, hapus)
- Statistik dan aksi cepat

## Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Sesuaikan koneksi database di `.env`, lalu:

```bash
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Akun Admin

| Email | Password |
| --- | --- |
| `admin@gmail.com` | `admin123` |

> Ganti password setelah login demi keamanan.

## Cara Mengubah Konten

1. Login di `/login`
2. **Profil & Konten** — ubah nama, kelas, deskripsi, kontak, dan teks bagian lain
3. **Proyek / Sertifikat / Pengalaman / Keahlian / Testimoni / Blog** — tambah, edit, hapus data
4. **Pesan Masuk** — baca pesan pengunjung
5. Perubahan langsung tampil di website tanpa edit kode

Konfigurasi field admin ada di `config/portfolio.php`.

## Deliverable UKK — Junior Programming

Selain aplikasi Laravel, tersedia SPA vanilla sesuai soal **"The Professional Portfolio"** di folder `public/LSP_Dina/`:

```
https://portofolio-dina.test/LSP_Dina/index.html
https://portofolio-dina.test/LSP_Dina/tests.html
```

Berisi `index.html`, `style.css`, `main.js`, `foto-dina.jpg`, dan halaman pengujian unit.
Menyediakan Identity Section, Portfolio Gallery, dan Admin Dashboard dengan tambah/hapus proyek,
filter Web/Mobile/IoT tanpa reload, serta penyimpanan permanen memakai `localStorage`.
Seluruh fungsi utama diberi komentar pemetaan unit kompetensi. Detail lengkap ada di `public/LSP_Dina/README.md`.

## Struktur Penting

| Path | Fungsi |
| --- | --- |
| `public/LSP_Dina/` | Deliverable SPA UKK (HTML, CSS, JS murni + unit test) |
| `config/portfolio.php` | Definisi setting profil & field CRUD admin |
| `app/Http/Controllers/CrudController.php` | Mesin CRUD generik untuk semua konten |
| `app/Models/Setting.php` | Key-value setting website |
| `resources/views/welcome.blade.php` | Halaman portfolio publik |
| `resources/views/cv.blade.php` | CV digital |
| `resources/views/admin/` | Tampilan dashboard admin |
| `database/seeders/DatabaseSeeder.php` | Data contoh |

## Deploy ke Railway

Panduan lengkap ada di [`RAILWAY.md`](RAILWAY.md). Ringkasnya: Hubungkan repo ke Railway,
tambah MySQL, isi environment variable, generate domain, dan pasang Volume di
`/app/storage/app/public` agar gambar upload tidak hilang saat redeploy.
Perubahan kode/tampilan cukup di-`push`, sedangkan konten diubah lewat dashboard.

## Pengujian

```bash
php artisan test
```

Pengujian unit SPA UKK: buka `https://portofolio-dina.test/LSP_Dina/tests.html` (13 test case).

## Teknologi

Laravel 12, Tailwind CSS 4, Vite, MySQL, JavaScript (Intersection Observer, modal, filter).

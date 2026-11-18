# Deploy ke Railway — Portfolio Dina

Panduan ini khusus untuk project ini (Laravel 12 + Tailwind 4 + MySQL).

## Prinsip utama

| Yang diubah | Cara update | Perlu redeploy? |
| --- | --- | --- |
| Kode, tampilan, CSS, JS, Blade | `git push origin main` | ✅ Ya, otomatis |
| Konten (proyek, teks, sertifikat, blog, testimoni) | Dashboard `/dashboard` | ❌ Tidak perlu |

Railway terhubung ke GitHub. Setiap push ke `main` memicu build & deploy otomatis.

---

## 1. Siapkan repository

Pastikan semua perubahan sudah ter-push:

```bash
git status
git push origin main
```

File yang sudah disiapkan untuk Railway:

- `railway.json` — pilihan builder Railpack & perintah pre-deploy
- `railway/init-app.sh` — migrasi, seed awal, storage link, cache
- `database/seeders/RailwaySeeder.php` — seed hanya saat database kosong
- `app/helpers.php` — fallback gambar yang belum tersedia
- `public/css/app.css` + `public/js/app.js` — aset dengan **nama tetap**, dipanggil langsung oleh Blade. Tidak bergantung pada manifest Vite, jadi CSS tetap tampil walau build di Railway gagal.

---

## 2. Buat project di Railway

1. Buka <https://railway.com> → **New Project**.
2. Pilih **Deploy from GitHub repo** → pilih `dina-aja/portfolio-dina`.
3. Tunggu proses build pertama. Kegagalan di tahap ini **normal** karena environment variable belum diisi.
4. Di canvas project, klik **+ New → Database → MySQL**.
5. Buka service web → **Settings → Networking → Generate Domain**.
   Domain akan berbentuk `https://xxxx.up.railway.app`.

---

## 3. Environment Variables

Buka service web → **Variables → Raw Editor**, lalu isi:

```dotenv
APP_NAME="Portfolio Dina"
APP_ENV=production
APP_KEY=base64:PASTE_APP_KEY_DISINI
APP_DEBUG=false
APP_URL=https://xxxx.up.railway.app

LOG_CHANNEL=stderr
SESSION_DRIVER=database
CACHE_STORE=database
FILESYSTEM_DISK=public

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

### Cara mendapatkan `APP_KEY`

Jalankan di komputer Anda (di folder project):

```bash
php artisan key:generate --show
```

Salin seluruh hasilnya (diawali `base64:`) ke variabel `APP_KEY`.
**Jangan** menyalin `.env` lokal ke Railway — `.env` sengaja tidak ikut ke GitHub.

### Catatan variabel

- `${{MySQL.MYSQLHOST}}` adalah referensi otomatis ke service MySQL di project yang sama. Pastikan nama service tepat `MySQL`; jika berbeda, sesuaikan.
- `SESSION_DRIVER=database` membuat login admin tetap bertahan setelah redeploy (tabel `sessions` sudah disiapkan lewat migrasi).
- `LOG_CHANNEL=stderr` membuat error tampil di tab **Logs** Railway.

---

## 4. Perintah build & deploy

`railway.json` hanya menentukan builder, pre-deploy, healthcheck, dan restart policy. **Jangan mengisi Custom Build Command / Start Command** — Railpack akan menimpa langkah bawaan Laravel (composer install + npm build) kalau diisi manual.

| Tahap | Yang terjadi otomatis |
| --- | --- |
| Deteksi | Railpack mengenali Laravel dari `artisan` + `composer.json`, memilih PHP 8.2+ |
| Install | `composer install` dan `npm install` |
| Build | `npm run build` (aset Vite/Tailwind), lalu optimasi config/event/route/view |
| Pre-deploy | `railway/init-app.sh` → migrate + seed awal + storage link + segarkan cache |
| Start | **Default:** FrankenPHP + Caddy dengan document root `/app/public`. Migrasi & storage link juga dijalankan ulang otomatis saat start (aman, karena idempoten). |

> ⚠️ Jangan mengisi Custom Start Command dengan `php artisan serve`. Itu server development dan tidak cocok untuk produksi.

Kalau ingin menonaktifkan migrasi otomatis Railpack (karena sudah di pre-deploy), tambahkan variabel `RAILPACK_SKIP_MIGRATIONS=true`. Tidak wajib.

Setelah variabel terisi, klik **Deploy**. Tunggu hingga status berhasil, lalu buka domain.

---

## 5. Volume agar gambar upload tidak hilang ⚠️

Filesystem Railway bersifat sementara. Tanpa volume, gambar yang di-upload lewat admin akan hilang saat redeploy.

1. Di canvas project, klik **+ New → Volume**.
2. Pilih service web saat diminta.
3. Set **Mount Path**:

```
/app/storage/app/public
```

4. Jika muncul error permission saat upload, tambahkan variabel:

```dotenv
RAILWAY_RUN_UID=0
```

5. Deploy ulang.

Setelah volume aktif:
- Gambar yang di-upload admin tersimpan permanen.
- Gambar contoh bawaan seeder yang tidak tersedia otomatis diganti placeholder (lewat `stored_image()`), jadi tidak ada ikon rusak.
- Symlink `public/storage` sudah dibuat otomatis oleh `init-app.sh`.

---

## 6. Verifikasi setelah deploy

Buka alamat-alamat ini:

| Halaman | Harapan |
| --- | --- |
| `/` | Beranda tampil, CSS termuat, tidak ada gambar rusak |
| `/cv` | CV digital tampil |
| `/blog/{slug}` | Artikel tampil |
| `/LSP_Dina/index.html` | SPA UKK tampil |
| `/LSP_Dina/tests.html` | 13/13 pengujian lulus |
| `/login` | Form login tampil |

Login dengan `admin@gmail.com` / `admin123`, lalu **ganti password** segera.

Cek tab **Logs** → tidak boleh ada `Fatal error` atau `SQLSTATE`.

---

## 7. Workflow sehari-hari

### Mengubah tampilan / kode

```bash
# edit file, lalu:
npm run build          # wajib kalau mengubah CSS/JS
git add -A             # termasuk public/build yang ikut ter-commit
git commit -m "Deskripsi perubahan"
git push origin main
```

Railway otomatis build & deploy. Tunggu beberapa menit, lalu refresh browser dengan `Ctrl+F5`.

> `npm run build` sekarang melakukan dua hal: `vite build` **dan** menyalin hasilnya ke `public/css/app.css` + `public/js/app.js` (nama tetap, tanpa hash). Kedua file itu **sengaja disimpan di Git**. Blade memanggil langsung `/css/app.css`, jadi tidak ada ketergantungan pada `manifest.json` di server. Setiap kali mengubah CSS/JS, jalankan `npm run build` lalu commit semua hasilnya.

### Mengubah konten

Login ke `/dashboard` pada domain Railway → edit di menu **Profil & Konten**, **Proyek**, **Sertifikat**, dll.
Perubahan langsung tampil tanpa redeploy.

### Backup database

Railway → service MySQL → tab **Backups** → aktifkan backup otomatis. Disarankan sebelum eksperimen besar.

---

## 8. Troubleshooting

| Gejala | Penyebab & solusi |
| --- | --- |
| Halaman 500 | Cek Logs. Pastikan `APP_KEY` terisi dan variabel DB benar. |
| Tampilan tanpa CSS / hanya teks | Buka `https://domain-anda/css/app.css` — harus menampilkan teks CSS. Kalau 404: jalankan `npm run build` di komputer, lalu `git add -A && git commit -m "Fix CSS" && git push`. Tunggu deploy Railway sukses, lalu `Ctrl+F5`. |
| Gambar 404 | Volume belum terpasang di `/app/storage/app/public`, atau jalankan ulang deploy agar `storage:link` dibuat. |
| Login gagal / logout sendiri | Pastikan `SESSION_DRIVER=database` dan migrasi `sessions` berhasil. |
| Data berubah sendiri setelah redeploy | `RailwaySeeder` hanya jalan saat tabel `settings` kosong. Cek apakah data memang terhapus. |
| Error permission saat upload | Tambahkan `RAILWAY_RUN_UID=0`. |
| Build gagal di PHP | Pastikan Railway memilih PHP ≥ 8.2 (project membutuhkan PHP 8.2+). |

---

## 9. Catatan biaya

Railway tidak sepenuhnya gratis. MySQL dan Volume biasanya memakai resource berbayar setelah masa trial/hobby quota habis. Pantau pemakaian di dashboard Railway agar tidak terkejut.

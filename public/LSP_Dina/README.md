# LSP_Dina — The Professional Portfolio

Deliverable praktik UKK Okupasi **Junior Programming** (Rekayasa Perangkat Lunak).

## Cara menjalankan

Buka `index.html` langsung di browser (tidak perlu server atau instalasi).
Untuk pengujian, buka `tests.html`.

## Isi folder

| File | Fungsi |
| --- | --- |
| `index.html` | Struktur SPA: Identity Section, Portfolio Gallery, Admin Dashboard |
| `style.css` | Tampilan responsif, dark/light mode, animasi kartu |
| `main.js` | Logika: struktur data, localStorage, filter, form, hapus, validasi |
| `foto-dina.jpg` | Foto profil wajib (.jpg) |
| `tests.html` | Halaman pengujian unit (13 test case) |
| `test-runner.js` | Kumpulan test case dan assertion |

## Fitur wajib sesuai soal

- ✅ Identity Section: foto profil, nama, bio singkat
- ✅ Portfolio Gallery: kartu berisi thumbnail `.jpg`, nama, kategori teknologi, deskripsi
- ✅ Admin Dashboard: formulir tambah proyek
- ✅ Fungsi Tambah Proyek
- ✅ Fungsi Hapus Proyek (dengan konfirmasi)
- ✅ Filter kategori **Web / Mobile / IoT** tanpa reload halaman
- ✅ Data persistence memakai `localStorage` (tidak hilang saat refresh)
- ✅ Penanganan error gambar (thumbnail fallback)
- ✅ Validasi input formulir
- ✅ Tombol reset data awal

## Pemetaan unit kompetensi

| Unit Kompetensi | Penerapan |
| --- | --- |
| J.620100.004.02 | `Array of Objects` pada `getDefaultProjects()`, pembacaan/penulisan `localStorage` di `loadProjects()` & `saveProjects()` |
| J.620100.009.01 | Seluruh bagian dibuat sesuai spesifikasi soal (3 section, format folder `LSP_NAMA`) |
| J.620100.010.01 | `addEventListener` pada form, filter, tombol admin, tema, hapus, dan modal |
| J.620100.016.01 | Indentasi 4 spasi, nama fungsi deskriptif, `use strict`, komentar di setiap fungsi |
| J.620100.017.02 | `forEach`/`filter` untuk looping dan filtering kategori di `renderProjects()` & `filterProjects()` |
| J.620100.023.02 | Komentar dokumentasi `@param` / `@returns` di atas fungsi utama |
| J.620100.025.02 | `validateProject()`, `handleImageError()`, try/catch pada `localStorage`, guard di `init()` |
| J.620100.033.02 | `tests.html` + `test-runner.js`: 13 test case, semua lulus |

## Akses di server lokal

Folder ini juga tersedia melalui:

```
https://portofolio-dina.test/LSP_Dina/index.html
https://portofolio-dina.test/LSP_Dina/tests.html
```

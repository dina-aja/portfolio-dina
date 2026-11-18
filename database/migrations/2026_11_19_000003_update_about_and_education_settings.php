<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Perbarui narasi "Tentang Saya", nama sekolah, dan riwayat pendidikan.
     *
     * Dijalankan sekali pada deploy berikutnya, sehingga perubahan langsung
     * terlihat di Railway walau nilai tersimpan di database produksi.
     */
    public function up(): void
    {
        $values = [
            'school' => 'SMK Negeri 2 Banjarmasin',
            'about_biodata' => 'Saya adalah Dina, siswa kelas XII PPLG 1 di SMK Negeri 2 Banjarmasin, jurusan Pengembangan Perangkat Lunak dan Gim (PPLG). Minat saya pada dunia pemrograman terasah lewat proyek aplikasi web yang saya bangun dengan HTML, CSS, JavaScript, PHP, MySQL, dan Laravel. Saya senang mempelajari hal baru, mencoba teknologi yang belum pernah dipakai, dan menjadikan setiap proyek sebagai sarana mengasah keterampilan sekaligus menambah pengalaman. Saya berdomisili di Banjarmasin, Kalimantan Selatan, dan dapat dihubungi melalui dinadinaa639@gmail.com.',
            'education' => "SDN Kuin Utara 7 Banjarmasin\n2015 – 2021\n\nSMPN 5 Banjarmasin\n2021 – 2024\n\nSMK Negeri 2 Banjarmasin\nPengembangan Perangkat Lunak dan Gim (PPLG)\n2024 – 2027",
        ];

        foreach ($values as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function down(): void
    {
        // Sengaja tidak mengembalikan teks lama. Nilai dapat diedit lagi
        // lewat dashboard admin tanpa mengubah kode.
    }
};

<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('stored_image')) {
    /**
     * Ambil URL gambar dari disk "public".
     *
     * Di Railway, file gambar contoh bawaan seeder tidak ikut ter-upload.
     * Fungsi ini memastikan gambar yang belum tersedia menampilkan placeholder
     * daripada ikon rusak, baik di halaman publik maupun di admin.
     *
     * @param  string|null  $path  Path relatif pada storage/app/public
     * @param  string|null  $fallback  URL pengganti opsional
     * @return string URL gambar yang siap dipakai pada atribut src
     */
    function stored_image(?string $path, ?string $fallback = null): string
    {
        if (! empty($path) && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        return $fallback ?? asset('images/placeholder.svg');
    }
}

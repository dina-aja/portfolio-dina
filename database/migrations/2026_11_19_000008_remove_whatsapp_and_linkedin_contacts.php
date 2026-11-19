<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus jejak kontak WhatsApp & LinkedIn dari data yang tersimpan.
     * Kolom pengaturan sudah dihapus dari config, baris lama tidak dipakai lagi.
     */
    public function up(): void
    {
        if (Schema::hasColumn('projects', 'features')) {
            DB::table('projects')
                ->where('features', 'like', '%Tombol kontak WhatsApp%')
                ->update([
                    'features' => DB::raw("REPLACE(features, 'Tombol kontak WhatsApp', 'Tombol kontak')"),
                ]);
        }

        DB::table('settings')->whereIn('key', ['whatsapp', 'linkedin'])->delete();
    }

    public function down(): void
    {
        // Pembersihan konten bersifat sekali jalan.
    }
};

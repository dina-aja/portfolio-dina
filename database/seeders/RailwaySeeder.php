<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seed data awal HANYA pada deploy pertama.
 *
 * Railway menjalankan seeder ini setiap kali deploy. Pengecekan Setting
 * memastikan perubahan yang dibuat lewat dashboard admin tidak ditimpa
 * oleh data contoh saat aplikasi di-deploy ulang.
 */
class RailwaySeeder extends Seeder
{
    public function run(): void
    {
        if (Setting::query()->exists()) {
            $this->command?->info('Data sudah ada - seeding dilewati.');

            return;
        }

        $this->call(DatabaseSeeder::class);
    }
}

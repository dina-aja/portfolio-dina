<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Kembalikan akses admin ke kredensial bawaan (sekali jalan saat deploy).
     *
     * Email : admin@gmail.com
     * Password: admin123
     *
     * Setelah login, disarankan mengganti password lagi lewat dashboard.
     */
    public function up(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Dina',
                'password' => Hash::make('admin123'),
            ]
        );
    }

    public function down(): void
    {
        // Password sengaja tidak dikembalikan ke nilai sebelumnya.
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah penilaian bintang 1-5 pada testimoni.
     * Data lama mendapat nilai default 5 agar tetap tampil wajar.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('testimonials', 'rating')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->unsignedTinyInteger('rating')->default(5)->after('message');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('testimonials', 'rating')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropColumn('rating');
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Testimoni baru dari pengunjung otomatis menunggu persetujuan admin.
     * Data lama tetap tampil karena default true.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('testimonials', 'is_approved')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->boolean('is_approved')->default(true)->after('avatar');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('testimonials', 'is_approved')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropColumn('is_approved');
            });
        }
    }
};

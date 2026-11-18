<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('certificates')) {
            Schema::create('certificates', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('issuer')->nullable();
                $table->string('year')->nullable();
                $table->string('category')->default('Sertifikat');
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        } else {
            // Sesuaikan tabel sertifikat yang sudah ada tanpa menghapus data
            Schema::table('certificates', function (Blueprint $table) {
                // Kolom lama bersifat wajib; longarkan agar data baru bisa disimpan
                if (Schema::hasColumn('certificates', 'type')) {
                    $table->string('type')->nullable()->change();
                }
                if (! Schema::hasColumn('certificates', 'category')) {
                    $table->string('category')->nullable()->default('Sertifikat');
                }
                if (! Schema::hasColumn('certificates', 'year')) {
                    $table->string('year')->nullable();
                }
            });

            if (Schema::hasColumn('certificates', 'type')) {
                DB::table('certificates')->whereNull('category')->update(['category' => DB::raw('`type`')]);
            }
            if (Schema::hasColumn('certificates', 'date')) {
                foreach (DB::table('certificates')->whereNull('year')->pluck('date', 'id') as $id => $date) {
                    DB::table('certificates')->where('id', $id)->update([
                        'year' => $date ? date('Y', strtotime($date)) : null,
                    ]);
                }
            }
        }

        foreach ([
            'experiences' => function (Blueprint $table) {
                $table->id();
                $table->string('type')->default('Organisasi');
                $table->string('title');
                $table->string('organization')->nullable();
                $table->string('period')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            },
            'skills' => function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category')->default('Hard Skill');
                $table->unsignedTinyInteger('percentage')->default(80);
                $table->string('icon')->nullable();
                $table->timestamps();
            },
            'testimonials' => function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('role')->nullable();
                $table->string('category')->default('Teman');
                $table->text('message');
                $table->string('avatar')->nullable();
                $table->timestamps();
            },
            'blog_posts' => function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('excerpt')->nullable();
                $table->longText('content');
                $table->string('category')->default('Catatan Ngoding');
                $table->string('image')->nullable();
                $table->dateTime('published_at')->nullable();
                $table->timestamps();
            },
            'messages' => function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('subject')->nullable();
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamps();
            },
            'settings' => function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            },
        ] as $tableName => $callback) {
            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, $callback);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('experiences');
    }
};

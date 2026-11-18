<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
            if (! Schema::hasColumn('projects', 'category')) {
                $table->string('category')->nullable()->default('Website')->after('slug');
            }
            if (! Schema::hasColumn('projects', 'problem')) {
                $table->text('problem')->nullable();
            }
            if (! Schema::hasColumn('projects', 'goal')) {
                $table->text('goal')->nullable();
            }
            if (! Schema::hasColumn('projects', 'technologies')) {
                $table->text('technologies')->nullable();
            }
            if (! Schema::hasColumn('projects', 'role')) {
                $table->string('role')->nullable();
            }
            if (! Schema::hasColumn('projects', 'features')) {
                $table->text('features')->nullable();
            }
            if (! Schema::hasColumn('projects', 'story')) {
                $table->text('story')->nullable();
            }
            if (! Schema::hasColumn('projects', 'detail')) {
                $table->text('detail')->nullable();
            }
            if (! Schema::hasColumn('projects', 'documentation')) {
                $table->text('documentation')->nullable();
            }
            if (! Schema::hasColumn('projects', 'feedback')) {
                $table->text('feedback')->nullable();
            }
            if (! Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });

        // Amankan data lama dari skema sebelumnya
        if (Schema::hasColumn('projects', 'purpose')) {
            DB::table('projects')->whereNull('goal')->update(['goal' => DB::raw('`purpose`')]);
        }
        if (Schema::hasColumn('projects', 'technology')) {
            DB::table('projects')->whereNull('technologies')->update(['technologies' => DB::raw('`technology`')]);
        }
        if (Schema::hasColumn('projects', 'slug')) {
            foreach (DB::table('projects')->whereNull('slug')->pluck('title', 'id') as $id => $title) {
                DB::table('projects')->where('id', $id)->update([
                    'slug' => \Illuminate\Support\Str::slug($title) . '-' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(4)),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            foreach ([
                'slug', 'category', 'problem', 'goal', 'technologies', 'role',
                'features', 'story', 'detail', 'documentation', 'feedback', 'is_featured',
            ] as $column) {
                if (Schema::hasColumn('projects', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

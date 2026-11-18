<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'problem',
        'goal',
        'technologies',
        'role',
        'features',
        'story',
        'detail',
        'image',
        'github',
        'demo',
        'documentation',
        'feedback',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title) . '-' . Str::lower(Str::random(4));
            }
        });
    }

    public function getTechnologyListAttribute(): array
    {
        return $this->splitList($this->technologies);
    }

    public function getFeatureListAttribute(): array
    {
        return $this->splitList($this->features);
    }

    private function splitList(?string $value): array
    {
        if (! $value) {
            return [];
        }

        return collect(preg_split('/[\n,]+/', $value))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}

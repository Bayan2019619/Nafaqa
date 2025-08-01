<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuidAndSlug
{
    // Boot the trait
    public static function bootHasUuidAndSlug(): void
    {
        static::creating(function ($model) {
            // Assign UUID if not set
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            // Generate slug from name if not set
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = Str::slug($model->name);

                // Ensure uniqueness of slug
                $original = $model->slug;
                $count = 1;
                while (static::where('slug', $model->slug)->exists()) {
                    $model->slug = "{$original}-{$count}";
                    $count++;
                }
            }
        });
    }

    // Route key name for implicit binding
    public function getRouteKeyName(): string
    {
        return 'slug'; // or return 'uuid' if you want API-style
    }

    // Route binding resolution to allow slug or uuid
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)
                    ->orWhere('uuid', $value)
                    ->firstOrFail();
    }

    // Add uuid and slug to fillable if model allows mass-assignment
    public function initializeHasUuidAndSlug(): void
    {
        $this->fillable[] = 'uuid';
        $this->fillable[] = 'slug';
    }
}

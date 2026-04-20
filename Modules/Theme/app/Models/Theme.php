<?php

namespace Modules\Theme\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Theme extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'thumbnail', 'is_active'];

    public static function active(): ?self
    {
        return static::where('is_active', true)->first();
    }

    public function activate(): void
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
        Cache::forget('active_theme_slug');
    }
}

<?php

namespace Modules\News\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Department;
use App\Models\User;

class News extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'faculty_id',
        'department_id',
        'news_category_id',
        'title',
        'slug',
        'short_description',
        'content',
        'news_date',
        'publish_date',
        'is_featured',
        'is_pinned',
        'is_breaking',
        'status',
        'created_by',
    ];

    protected $casts = [
        'news_date' => 'date',
        'publish_date' => 'datetime',
        'is_featured' => 'boolean',
        'is_pinned' => 'boolean',
        'is_breaking' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

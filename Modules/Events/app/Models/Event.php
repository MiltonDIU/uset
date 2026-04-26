<?php

namespace Modules\Events\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Department;
use App\Models\User;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'faculty_id',
        'department_id',
        'event_category_id',
        'title',
        'slug',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'venue',
        'organizer',
        'contact_person',
        'status',
        'is_featured',
        'is_published',
        'created_by',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
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

    /**
     * Auto-calculate status based on date
     */
    public function getAutoStatusAttribute(): string
    {
        $today = now()->startOfDay();
        $eventDate = $this->event_date->startOfDay();

        if ($this->status === 'Cancelled') {
            return 'Cancelled';
        }

        if ($eventDate->gt($today)) {
            return 'Upcoming';
        }

        if ($eventDate->eq($today)) {
            return 'Running';
        }

        return 'Completed';
    }
}

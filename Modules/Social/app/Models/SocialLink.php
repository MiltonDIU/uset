<?php

namespace Modules\Social\app\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'platform',
        'url',
        'icon',
        'is_active',
        'sort_order',
    ];

    public static function getPlatformIcons(): array
    {
        return [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin-in',
            'youtube' => 'fab fa-youtube',
            'whatsapp' => 'fab fa-whatsapp',
            'github' => 'fab fa-github',
            'website' => 'fas fa-link',
        ];
    }
}

<?php

namespace Modules\FAQ\app\Services;

use Modules\FAQ\app\Models\Faq;

class FAQService
{
    public function getActiveFaqs()
    {
        return Faq::with('category')->where('is_active', true)->orderBy('sort_order')->get();
    }
}

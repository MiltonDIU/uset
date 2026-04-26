<?php

namespace Modules\Testimonials\app\Services;

use Modules\Testimonials\app\Models\Testimonial;

class TestimonialsService
{
    public function getActiveTestimonials()
    {
        return Testimonial::where('is_active', true)->orderBy('sort_order')->get();
    }

    public function getFeaturedTestimonials()
    {
        return Testimonial::where('is_active', true)->where('is_featured_on_home', true)->orderBy('sort_order')->get();
    }
}

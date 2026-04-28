@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $page->meta_title ?? $page->title)

@section('content')
    @php
        $hasPageHero = false;
        if (isset($page->content)) {
            $contentJson = is_string($page->content) ? $page->content : json_encode($page->content);
            if (strpos($contentJson, '"type":"page_hero"') !== false) {
                $hasPageHero = true;
            }
        }
    @endphp

    @if(!$hasPageHero)
        <!-- Page Header (Fallback using Page Builder Style) -->
        @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('sections.page_hero'), ['content' => []])
    @endif

    <!-- Page Content -->
    <div class="page-content">
        @if(isset($page) && is_array($page->content))
            @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $page->content])
        @else
            <div class="container py-5 text-center">
                <p class="text-muted">No content available for this page.</p>
            </div>
        @endif
    </div>
@endsection

@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $page->meta_title ?? $page->title)

@section('content')
    @php
        $hasPageHero = false;
        if (isset($page->content) && is_array($page->content)) {
            foreach ($page->content as $block) {
                if ($block['type'] === 'page_hero') {
                    $hasPageHero = true;
                    break;
                }
            }
        }
    @endphp

    @if(!$hasPageHero)
        <!-- Page Header (Fallback) -->
        <section class="page-header bg-light py-5">
            <div class="container text-center">
                <h1 class="display-4 font-weight-bold">{{ $page->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item"><a href="/" class="text-success">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </section>
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

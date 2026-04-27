@php
    $title = $content['title'] ?? ($page->title ?? '');
    $description = $content['description'] ?? '';

    $breadcrumbs = [];
    if (isset($page)) {
        $breadcrumbs[] = ['name' => $page->title, 'url' => url($page->slug)];
    }
@endphp

@include('themes.default.partials.page-hero', [
    'title' => $title,
    'description' => $description,
    'breadcrumbs' => $breadcrumbs,
    'show_breadcrumbs' => $content['show_breadcrumbs'] ?? true
])

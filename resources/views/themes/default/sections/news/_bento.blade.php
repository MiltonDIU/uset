@php $items = $newsList instanceof \Illuminate\Pagination\LengthAwarePaginator ? $newsList->items() : $newsList->all(); @endphp
@if(count($items) > 0)
<div class="ne-bento-grid">
    {{-- First large item --}}
    <div class="ne-bento-large">
        @include('themes.default.sections.news._card_large', ['news' => $items[0]])
    </div>
    {{-- Remaining small items --}}
    <div class="ne-bento-small">
        @foreach(array_slice($items, 1) as $news)
            @include('themes.default.sections.news._card_small', ['news' => $news])
        @endforeach
    </div>
</div>
@else
<div class="text-center py-5">
    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
    <h5 class="text-muted">No news published yet</h5>
</div>
@endif

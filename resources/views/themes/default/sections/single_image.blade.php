<div class="cms-single-image {{ $content['alignment'] ?? 'text-center' }} my-4">
    @if(!empty($content['image']))
        <figure class="figure d-inline-block">
            <img src="{{ Storage::url($content['image']) }}" class="figure-img img-fluid rounded shadow-sm" alt="{{ $content['caption'] ?? '' }}">
            @if(!empty($content['caption']))
                <figcaption class="figure-caption text-center mt-2">{{ $content['caption'] }}</figcaption>
            @endif
        </figure>
    @endif
</div>

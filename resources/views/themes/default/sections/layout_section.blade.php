<section class="cms-layout-section {{ $content['background_color'] ?? 'bg-white' }} {{ $content['padding_y'] ?? 'py-5' }}">
    <div class="{{ ($content['is_full_width'] ?? false) ? 'container-fluid' : 'container' }}">
        <div class="row">
            @foreach($content['columns'] ?? [] as $column)
                <div class="{{ $column['width'] ?? 'col-md-12' }}">
                    @if(isset($column['content']))
                        @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $column['content']])
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

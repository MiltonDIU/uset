<section class="cms-layout-section {{ $content['background_color'] ?? 'bg-white' }} {{ $content['padding_y'] ?? 'py-5' }}">
    <div class="{{ ($content['is_full_width'] ?? false) ? 'container-fluid' : 'container' }}">
        <div class="row">
            @php
                $layout = $content['layout'] ?? '12';
                $spans = explode(',', $layout);
            @endphp
            
            @foreach($spans as $index => $span)
                @php
                    $colIndex = $index + 1;
                    $colData = $content["col{$colIndex}_content"] ?? [];
                    $gridClass = "col-md-" . trim($span);
                @endphp
                
                <div class="{{ $gridClass }}">
                    @if(!empty($colData))
                        @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $colData])
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

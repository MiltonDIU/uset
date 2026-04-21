@php
    $themeService = app(\Modules\Theme\app\Services\ThemeService::class);
    $theme = $themeService->current();
    
    $bgClass = $content['background_color'] ?? 'bg-white';
    $paddingClass = $content['padding_y'] ?? 'py-5';
    $containerType = $content['container_type'] ?? 'container';
    
    $layout = $content['layout'] ?? '12';
    $spans = explode(',', $layout);
@endphp

<section class="cms-layout-section {{ $bgClass }} {{ $paddingClass }}">
    {{-- Conditionally wrap in container and row --}}
    @if($containerType !== 'no-wrapper')
        <div class="{{ $containerType }}">
            <div class="row">
    @endif

    @foreach($spans as $index => $span)
        @php
            $colIndex = $index + 1;
            $colData = $content["col{$colIndex}_content"] ?? [];
            
            // Dynamic Grid Class from Active Theme
            $gridClass = $theme ? $theme->getGridClass($span) : "col-md-" . trim($span);
        @endphp
        
        @if($containerType === 'no-wrapper')
            {{-- Direct output for raw sections --}}
            @if(!empty($colData))
                @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $colData])
            @endif
        @else
            <div class="{{ $gridClass }}">
                @if(!empty($colData))
                    @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $colData])
                @endif
            </div>
        @endif
    @endforeach

    @if($containerType !== 'no-wrapper')
            </div> {{-- End Row --}}
        </div> {{-- End Container --}}
    @endif
</section>

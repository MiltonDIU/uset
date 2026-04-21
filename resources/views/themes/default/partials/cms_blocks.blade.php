@if(isset($content) && is_array($content))
    @foreach($content as $block)
        @php
            $blockType = $block['type'];
            $blockData = $block['data'] ?? $block;
            $viewPath = app(\Modules\Theme\app\Services\ThemeService::class)->view('sections.' . $blockType);
        @endphp

        @if(view()->exists($viewPath))
            @include($viewPath, ['content' => $blockData])
        @endif
    @endforeach
@endif

@props([
    'title' => '',
    'description' => '',
    'breadcrumbs' => []
])

<section class="page-hero text-center fade-in">
    <div class="container">
        <h1 class="animate-in fade-in">{{ $title }}</h1>
        @if($description)
            <p class="animate-in fade-in" style="animation-delay: 0.1s;">{{ $description }}</p>
        @endif
        
        @if($show_breadcrumbs ?? true)
            <nav aria-label="breadcrumb" class="animate-in fade-in" style="animation-delay: 0.2s;">
                <ol class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    @foreach($breadcrumbs as $breadcrumb)
                        @if($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif

        @if(isset($slot) && trim($slot) !== '')
            <div class="mt-4 animate-in fade-in" style="animation-delay: 0.3s;">
                {!! $slot !!}
            </div>
        @endif
    </div>
</section>

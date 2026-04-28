@props([
    'title' => '',
    'description' => '',
    'breadcrumbs' => []
])

<section class="page-hero">
    <div class="container">
        <h1>{{ $title }}</h1>
        @if($description)
            <p>{{ $description }}</p>
        @endif
        
        @if($show_breadcrumbs ?? true)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
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
    </div>
</section>

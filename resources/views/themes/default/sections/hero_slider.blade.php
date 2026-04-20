<section class="hero-slider">
    @foreach($content['slides'] ?? [] as $slide)
        <div class="hero-slide" style="background-image: url('{{ $slide['image'] ? Storage::url($slide['image']) : theme_asset('img/new_banner_1.jpeg') }}')">
            <div class="container hero-content">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="display-4 font-weight-bold mb-4 mt-4">
                            {{ $slide['heading'] ?? '' }}
                        </h1>
                        @if(!empty($slide['subheading']))
                            <p class="lead">
                                {{ $slide['subheading'] }}
                            </p>
                        @endif
                        <div class="d-flex flex-wrap">
                            @if(!empty($slide['primary_button_text']))
                                <a href="{{ $slide['primary_button_url'] ?? '#' }}" class="btn btn-success btn-lg mr-3 mb-3">{{ $slide['primary_button_text'] }}</a>
                            @endif
                            @if(!empty($slide['secondary_button_text']))
                                <a href="{{ $slide['secondary_button_url'] ?? '#' }}" class="btn btn-outline-light btn-lg mb-3">{{ $slide['secondary_button_text'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>

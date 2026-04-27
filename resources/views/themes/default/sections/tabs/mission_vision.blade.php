<div class="row">
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="mission-box">
            <h2>{{ $data['mission_title'] ?? 'Our Mission' }}</h2>
            <div class="text-content">
                {!! nl2br(e($data['mission_content'] ?? '')) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="vision-box">
            <h2>{{ $data['vision_title'] ?? 'Our Vision' }}</h2>
            <div class="text-content">
                {!! nl2br(e($data['vision_content'] ?? '')) !!}
            </div>
        </div>
    </div>
</div>

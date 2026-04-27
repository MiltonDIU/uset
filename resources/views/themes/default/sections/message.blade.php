@php
    $image = $content['image'] ?? null;
    $name = $content['name'] ?? '';
    $designation = $content['designation'] ?? '';
    $organization = $content['organization'] ?? '';
    $messageTitle = $content['message_title'] ?? '';
    $messageContent = $content['content'] ?? '';
    $signatureText = $content['signature_text'] ?? '';
    $footerDesignation = $content['footer_designation'] ?? '';
    $footerOrganization = $content['footer_organization'] ?? '';

    // Simple drop-cap logic: wrap the first character of the first paragraph if it exists
    if ($messageContent) {
        $messageContent = preg_replace('/<p>(.)/', '<p><span class="drop-cap">$1</span>', $messageContent, 1);
    }
@endphp
<style>
        /* Custom Styles for the Chairman Message */
        .message-card {
            background-color: #f8f9fa;
            border-left: 5px solid #28a745;
            position: relative;
            z-index: 1;
        }
        .quote-icon-bg {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 8rem;
            color: #28a745;
            opacity: 0.05;
            z-index: -1;
        }
        .drop-cap {
            float: left;
            font-size: 4rem;
            line-height: 0.8;
            font-weight: 700;
            color: #28a745;
            margin-right: 12px;
            margin-top: 5px;
            font-family: 'Georgia', serif;
        }
        .message-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            text-align: justify;
        }
        .signature-font {
            font-family: 'Brush Script MT', 'Caveat', cursive, serif;
            font-size: 2.5rem;
            color: #28a745;
            transform: rotate(-2deg);
            display: inline-block;
        }
    </style>

<section class="chairman-message py-5">
    <div class="container py-4">
        <div class="row align-items-start">
            <div class="col-lg-4 col-md-5 mb-5 mb-md-0 text-center sticky-top" style="top: 120px;">
                <div class="position-relative d-inline-block">
                    @if($image)
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $name }}" class="img-fluid rounded shadow" style="max-height: 500px; width: 100%; object-fit: cover; border: 8px solid #fff;" />
                    @endif
                </div>
                <div class="mt-4">
                    <h3 class="font-weight-bold mb-1">{{ $name }}</h3>
                    <p class="text-success font-weight-bold mb-1">{{ $designation }}</p>
                    <p class="text-success font-weight-bold">{{ $organization }}</p>
                </div>
            </div>

            <div class="col-lg-8 col-md-7 px-lg-4">
                <div class="message-card p-4 p-md-5 rounded shadow-sm">
                    <i class="fas fa-quote-right quote-icon-bg"></i>

                    <h2 class="h3 font-weight-bold mb-4 text-dark">{{ $messageTitle }}</h2>

                    <div class="message-text">
                        {!! $messageContent !!}
                    </div>

                    <hr class="my-5 border-success" style="opacity: 0.2;">

                    <div class="mt-4 text-right">
                        <p class="mb-0 text-muted">Warm regards,</p>
                        @if($signatureText)
                            <span class="signature-font">{{ $signatureText }}</span>
                        @endif
                        <p class="mb-0 font-weight-bold text-dark mt-2">{{ $footerDesignation }}</p>
                        <p class="small text-muted">{{ $footerOrganization }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


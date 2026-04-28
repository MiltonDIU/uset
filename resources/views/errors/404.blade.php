@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'Page Not Found | USET')

@push('styles')
<style>
    .error-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at top right, rgba(0, 133, 88, 0.05), transparent),
                    radial-gradient(circle at bottom left, rgba(0, 133, 88, 0.05), transparent);
    }
    .error-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 2rem;
        padding: 4rem 2rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .error-code {
        font-size: 8rem;
        font-weight: 900;
        line-height: 1;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    .error-message {
        font-size: 1.5rem;
        color: #4a5568;
        margin-bottom: 2rem;
        font-weight: 500;
    }
    .error-description {
        color: #718096;
        margin-bottom: 3rem;
        line-height: 1.6;
    }
    .btn-home {
        background: var(--primary);
        color: white;
        padding: 0.8rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-home:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 133, 88, 0.2);
        text-decoration: none;
    }
    .bg-shape {
        position: absolute;
        width: 200px;
        height: 200px;
        background: var(--primary);
        opacity: 0.05;
        border-radius: 50%;
        z-index: -1;
    }
    .shape-1 { top: -50px; right: -50px; }
    .shape-2 { bottom: -50px; left: -50px; }
</style>
@endpush

@section('content')
<section class="error-section" style="padding-top: 10rem; padding-bottom: 5rem;">
    <div class="container d-flex justify-content-center">
        <div class="error-card">
            <div class="bg-shape shape-1"></div>
            <div class="bg-shape shape-2"></div>
            
            <div class="error-code">404</div>
            <h1 class="error-message">Oops! Page Not Found</h1>
            <p class="error-description">
                The page you are looking for might have been removed, had its name changed, 
                or is temporarily unavailable. Please check the URL or return to the homepage.
            </p>
            
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="/" class="btn-home mb-3 mb-sm-0 mx-2">
                    <i class="fas fa-home"></i> Back to Homepage
                </a>
                <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-5 py-2 mx-2">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

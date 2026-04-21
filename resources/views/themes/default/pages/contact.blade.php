@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $page->meta_title ?? $page->title)

@section('content')
    <!-- Combined Page Header & Hero for Contact -->
    <section class="contact-hero bg-success py-5 text-white">
        <div class="container text-center">
            <h1 class="display-4 font-weight-bold">{{ $page->title }}</h1>
            <p class="lead">We'd love to hear from you. Reach out to us for any queries.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <!-- Contact Info Sidebar -->
            <div class="col-lg-4 mb-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h3 class="h4 font-weight-bold mb-4">Contact Information</h3>
                        <ul class="list-unstyled">
                            <li class="d-flex mb-4">
                                <div class="icon-box mr-3 bg-success-light p-2 rounded">
                                    <i class="fas fa-map-marker-alt text-success"></i>
                                </div>
                                <div>
                                    <h5 class="h6 font-weight-bold mb-1">Our Address</h5>
                                    <p class="text-muted small mb-0">672, Kazibari Bus Stand, Bhuigar, Narayanganj</p>
                                </div>
                            </li>
                            <li class="d-flex mb-4">
                                <div class="icon-box mr-3 bg-success-light p-2 rounded">
                                    <i class="fas fa-phone text-success"></i>
                                </div>
                                <div>
                                    <h5 class="h6 font-weight-bold mb-1">Phone Number</h5>
                                    <a href="tel:+8801733360664" class="text-muted small">+8801733-360664</a>
                                </div>
                            </li>
                            <li class="d-flex mb-0">
                                <div class="icon-box mr-3 bg-success-light p-2 rounded">
                                    <i class="fas fa-envelope text-success"></i>
                                </div>
                                <div>
                                    <h5 class="h6 font-weight-bold mb-1">Email Address</h5>
                                    <a href="mailto:info@uset.ac" class="text-muted small">info@uset.ac</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content Area (supports CMS blocks) -->
            <div class="col-lg-8">
                @if(isset($page) && is_array($page->content))
                    @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $page->content])
                @endif
                
                <!-- Contact Form Placeholder (Static for this template) -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h3 class="h4 font-weight-bold mb-4">Send us a Message</h3>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg btn-block">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

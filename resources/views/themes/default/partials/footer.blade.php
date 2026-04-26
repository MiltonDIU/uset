<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <!-- University Info -->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="footer-brand mb-4">
                    @php
                        $activeTheme = app(\Modules\Theme\app\Services\ThemeService::class)->current();
                        $footerLogo = $activeTheme->getFirstMediaUrl('footer_logo');
                    @endphp
                    <img src="{{ $footerLogo ?: theme_asset('img/LOGO.png') }}" alt="USET Logo" class="footer-logo mb-3" />
                    <h5 class="text-white mb-3">
                        University of Skill Enrichment and Technology (USET)
                    </h5>
                </div>
                <p class="text-white-50 mb-4">
                    Bangladesh's first skill-based university, committed to providing
                    industry-relevant education to prepare students for the demands of
                    today's workplace.
                </p>
                <div class="social-icons">
                    @php
                        $socialService = app(\Modules\Social\app\Services\SocialService::class);
                        $socialLinks = $socialService->getActiveLinks();
                        
                        $platformIcons = \Modules\Social\app\Models\SocialLink::getPlatformIcons();
                    @endphp

                    @forelse($socialLinks as $link)
                        <a href="{{ $link->url }}" class="social-icon" target="_blank" aria-label="{{ ucfirst($link->platform) }}">
                            <i class="{{ $link->icon ?: ($platformIcons[$link->platform] ?? 'fas fa-link') }}"></i>
                        </a>
                    @empty
                        <!-- Fallback icons if none set in backend -->
                        <a href="#" class="social-icon" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" target="_blank" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endforelse
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 col-lg-2 mb-5 mb-lg-0">
                <h5 class="text-white mb-4">Quick Links</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Programs</a></li>
                    <li><a href="#">Admission</a></li>
                    <li><a href="#">Faculty</a></li>
                    <li><a href="#">Student Life</a></li>
                    <li><a href="#">News & Events</a></li>
                </ul>
            </div>

            <!-- Important Links -->
            <div class="col-md-4 col-lg-2 mb-5 mb-lg-0">
                <h5 class="text-white mb-4">Important Links</h5>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="#">Mission & Vision</a>
                    </li>
                    <li><a href="#">Academic Calendar</a></li>
                    <li><a href="#">Campus Facilities</a></li>
                    <li><a href="#">Scholarships</a></li>
                    <li><a href="#">Tuition & Fees</a></li>
                    <li>
                        <a href="https://studentportal.uset.ac/" target="_blank">Student Portal</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 col-lg-4">
                <h5 class="text-white mb-4">Contact Us</h5>
                <ul class="contact-info list-unstyled">
                    <li class="d-flex mb-3">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <span class="text-white-50">672, Kazibari Bus Stand, Bhuigar, (Near Signboard)
                            Narayanganj , Bangladesh</span>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="fas fa-phone contact-icon"></i>
                        <a href="tel:+8801733360664" class="text-white-50">+8801733-360664</a>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="fas fa-envelope contact-icon"></i>
                        <a href="mailto:info@uset.ac" class="text-white-50">info@uset.ac</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <div class="container">
            <hr class="footer-divider" />
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <p class="copyright mb-0">
                        &copy; {{ date('Y') }} University of Skill Enrichment & Technology. All Rights
                        Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <ul class="footer-bottom-links list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                        <li class="list-inline-item"><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('content')
    @if(isset($page) && is_array($page->content))
        @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.cms_blocks'), ['content' => $page->content])
    @else
        <!-- Fallback to static content if no CMS page is found -->
        <!-- Hero Section -->
        <section class="hero-slider">
            <div class="hero-slide" style="background-image: url('{{ theme_asset('img/new_banner_1.jpeg') }}')">
                <div class="container hero-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1 class="display-4 font-weight-bold mb-4 mt-4">
                                USET Chairman Meets and Congratulates Newly Appointed UGC Chairman
                            </h1>
                            <p class="lead">
                                Join our vibrant community of learners and innovators
                            </p>
                            <div class="d-flex flex-wrap">
                                <a href="#" class="btn btn-success btn-lg mr-3 mb-3">Campus Life</a>
                                <a href="#" class="btn btn-outline-light btn-lg mb-3">Join Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... other slides ... -->
            <div class="hero-slide" style="background-image: url('{{ theme_asset('img/AcademicCM.jpg') }}')">
                <div class="container hero-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1 class="display-4 font-weight-bold mb-4 mt-4">
                                1st Academic Council Meeting of USET
                            </h1>
                            <p class="lead">
                                The first Academic Council Meeting of the University of
                                Science and Engineering Technology (USET) marked a significant
                                milestone in shaping the institution’s academic framework.
                            </p>
                            <div class="d-flex flex-wrap">
                                <a href="#" class="btn btn-outline-light btn-lg mb-3">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- why-choose-section -->
        <section class="why-choose-section">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge badge-success px-3 py-2 mb-3">Why USET?</span>
                    <h2 class="section-title h1 mb-3">What Makes Us Different</h2>
                    <p class="lead text-muted mb-0 mx-auto" style="max-width: 700px">
                        USET offers a unique approach to higher education in Bangladesh,
                        focusing on practical skills and industry relevance. Discover what
                        sets us apart.
                    </p>
                </div>
                <div class="row" id="value-propositions"></div>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-outline-success btn-lg">
                        Learn More About USET
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Featured Programs -->
        <section class="featured-programs-section py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge badge-success px-3 py-2 mb-3">Our Programs</span>
                    <h2 class="section-title h1 mb-3">Featured Academic Programs</h2>
                    <p class="lead text-muted mb-0 mx-auto" style="max-width: 700px">
                        Discover our industry-relevant academic programs designed to
                        prepare you for professional success in the modern workplace.
                    </p>
                </div>
                <div class="row" id="featured-programs"></div>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-outline-success btn-lg">
                        Explore All Programs
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-5 stats-section bg-primary-700">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="h1 mb-3 text-white">USET By The Numbers</h2>
                    <p class="lead mb-0 text-white">Our growth and impact in numbers</p>
                </div>
                <div class="row">
                    <!-- Stat items -->
                    <div class="col-6 col-md-3 mb-4">
                        <div class="stat-item text-center">
                            <div class="stat-value text-white" data-target="2020">0</div>
                            <div class="stat-label text-white">Established</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <div class="stat-item text-center">
                            <div class="stat-value text-white" data-target="1000">0</div>
                            <div class="stat-label text-white">Students</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- News & Events -->
        <section class="news-events-section py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge badge-success px-3 py-2 mb-3">Stay Updated</span>
                    <h2 class="section-title h1 mb-3">Latest News & Events</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div id="recent-news"></div>
                    </div>
                    <div class="col-lg-6">
                        <div id="upcoming-events"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-wrapper text-center">
                    <h2 class="h1 text-white mb-4">Ready to Start Your Educational Journey?</h2>
                    <a href="#" class="btn btn-light btn-lg text-success">Apply Now</a>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Load value propositions
            const valuePropscontainer = document.getElementById("value-propositions");
            if (valuePropscontainer && valuePropscontainer.children.length === 0) {
                fetch("{{ theme_asset('data/university_info.json') }}")
                    .then((response) => response.json())
                    .then((data) => {
                        const valueProps = data.valuePropositions.slice(0, 3);
                        valueProps.forEach((prop) => {
                            const column = document.createElement("div");
                            column.className = "col-md-6 col-lg-4 mb-4";
                            column.innerHTML = `
                                <div class="card value-proposition h-100">
                                    <div class="card-body">
                                        <div class="value-icon mb-3">
                                            ${getIconForValueProposition(prop.icon)}
                                        </div>
                                        <h3 class="h5 font-weight-bold mb-3">${prop.title}</h3>
                                        <p class="text-muted mb-0">${prop.description}</p>
                                    </div>
                                </div>
                            `;
                            valuePropscontainer.appendChild(column);
                        });
                    })
                    .catch((error) =>
                        console.error("Error loading value propositions:", error),
                    );
            }

            // Load featured programs
            const programscontainer = document.getElementById("featured-programs");
            if (programscontainer && programscontainer.children.length === 0) {
                fetch("{{ theme_asset('data/programs.json') }}")
                    .then((response) => response.json())
                    .then((data) => {
                        const faculties = data.faculties;

                        // Select one program from each faculty for featured display
                        faculties.forEach((faculty) => {
                            if (faculty.programs.length > 0) {
                                const program = faculty.programs[0];

                                const column = document.createElement("div");
                                column.className = "col-md-6 col-lg-4 mb-4";

                                column.innerHTML = `
                                    <div class="card program-card h-100">
                                        <div class="program-header">
                                            <h3 class="h5 font-weight-bold mb-0">${program.name}</h3>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-muted mb-4">${program.description.substring(0, 150)}...</p>
                                            <a href="/program-detail.html?faculty=${faculty.id}&program=${program.id}" class="btn btn-success btn-block">
                                                View Program Details
                                            </a>
                                        </div>
                                    </div>
                                `;

                                programscontainer.appendChild(column);
                            }
                        });
                    })
                    .catch((error) => console.error("Error loading programs:", error));
            }

            // Load news and events
            const newscontainer = document.getElementById("recent-news");
            const eventscontainer = document.getElementById("upcoming-events");

            if ((newscontainer && newscontainer.children.length === 0) || (eventscontainer && eventscontainer.children.length === 0)) {
                fetch("{{ theme_asset('data/news.json') }}")
                    .then((response) => response.json())
                    .then((data) => {
                        // Load news
                        if (newscontainer && newscontainer.children.length === 0) {
                            const news = data.news.slice(0, 3);
                            news.forEach((item) => {
                                const newsItem = document.createElement("div");
                                newsItem.className = "card news-item mb-4";

                                const formattedDate = new Date(item.date).toLocaleDateString(
                                    "en-US",
                                    {
                                        year: "numeric",
                                        month: "short",
                                        day: "numeric",
                                    },
                                );

                                newsItem.innerHTML = `
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{ theme_asset('') }}${item.image}" alt="${item.title}" class="img-fluid rounded">
                                            </div>
                                            <div class="col-9">
                                                <div class="text-success small mb-1">${formattedDate}</div>
                                                <h4 class="h6 font-weight-bold mb-2">${item.title}</h4>
                                                <p class="small text-muted mb-0">${item.excerpt.substring(0, 100)}...</p>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                newscontainer.appendChild(newsItem);
                            });
                        }

                        // Load events
                        if (eventscontainer && eventscontainer.children.length === 0) {
                            const events = data.events.slice(0, 3);
                            events.forEach((event) => {
                                const eventItem = document.createElement("div");
                                eventItem.className = "card event-item mb-4";

                                const eventDate = new Date(event.startDate);
                                const day = eventDate.getDate();
                                const month = eventDate.toLocaleDateString("en-US", {
                                    month: "short",
                                });

                                eventItem.innerHTML = `
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="event-date mr-3">
                                                <span class="event-day">${day}</span>
                                                <span class="event-month">${month}</span>
                                            </div>
                                            <div>
                                                <h4 class="h6 font-weight-bold mb-2">${event.title}</h4>
                                                <p class="small text-muted mb-1"><i class="fas fa-map-marker-alt mr-2"></i>${event.location}</p>
                                                <p class="small text-muted mb-0">${event.description.substring(0, 100)}...</p>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                eventscontainer.appendChild(eventItem);
                            });
                        }
                    })
                    .catch((error) =>
                        console.error("Error loading news and events:", error),
                    );
            }
        });

        // Helper function to render icons for value propositions
        function getIconForValueProposition(iconName) {
            switch (iconName) {
                case "academic-cap":
                    return '<i class="fas fa-graduation-cap fa-lg"></i>';
                case "map":
                    return '<i class="fas fa-map-marked-alt fa-lg"></i>';
                case "briefcase":
                    return '<i class="fas fa-briefcase fa-lg"></i>';
                case "flag":
                    return '<i class="fas fa-flag fa-lg"></i>';
                case "globe-alt":
                    return '<i class="fas fa-globe-asia fa-lg"></i>';
                default:
                    return '<i class="fas fa-university fa-lg"></i>';
            }
        }
    </script>
@endpush

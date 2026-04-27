@php
    $tabs = $content['tabs'] ?? [];
    $id = 'tabs-' . uniqid();
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ theme_asset('css/about.css') }}">
    <style>
        .tabs-section { position: relative; top: 0; }
        .tab-content-section { padding-top: 0 !important; }

        /* Use Success Color for Tabs */
        .tab-btn:hover { color: var(--success); background: rgba(40,167,69,0.1); }
        .tab-btn.active { background: var(--success); box-shadow: 0 4px 15px rgba(40,167,69,0.2); }

        /* Full width timeline override */
        .tab-content-timeline .content-box {
            padding: 2rem 0;
            background: transparent;
            box-shadow: none;
        }
        .tab-content-timeline .timeline::before { background: var(--success); }
        .tab-content-timeline .timeline-item::before { border-color: var(--success); }
        .tab-content-timeline .milestone-icon i,
        .tab-content-timeline .year { background: var(--success); color: white; }
        .tab-content-timeline .milestone-header { background: rgba(40,167,69,0.05); }

        /* Other tab type color overrides */
        .tab-content .mission-box h2,
        .tab-content .vision-box h2,
        .tab-content .facility-icon i,
        .tab-content .leader-role,
        .tab-content .info-icon i,
        .tab-content .contact-item i {
            color: var(--success) !important;
        }

        .tab-content .mission-box::before,
        .tab-content .vision-box::before {
            background: linear-gradient(to right, var(--success), #34ce57);
        }

        .tab-content .facility-icon {
            background: rgba(40,167,69,0.1);
        }
    </style>
@endpush

@if(!empty($tabs))
    <div id="{{ $id }}" class="tabs-component-wrapper">
        <!-- Navigation Tabs -->
        <section class="tabs-section">
            <div class="container">
                <div class="tab-navigation">
                    @foreach($tabs as $index => $tab)
                        <button class="tab-btn {{ $index === 0 ? 'active' : '' }}"
                                data-tab="{{ Str::slug($tab['title']) }}-{{ $id }}">
                            {{ $tab['title'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Tab Contents -->
        <section class="tab-content-section py-5">

                @foreach($tabs as $index => $tab)
                    @php $tabId = Str::slug($tab['title']) . '-' . $id; @endphp
                    <div class="tab-content tab-content-{{ $tab['type'] }} {{ $index === 0 ? 'active' : '' }}"
                         id="{{ $tabId }}-content"
                         style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">

                        <div class="content-box">
                            @switch($tab['type'])
                                @case('mission_vision')
                                    @include('themes.default.sections.tabs.mission_vision', ['data' => $tab])
                                    @break
                                @case('timeline')
                                    @include('themes.default.sections.tabs.timeline', ['data' => $tab])
                                    @break
                                @case('facilities')
                                    @include('themes.default.sections.tabs.facilities', ['data' => $tab])
                                    @break
                                @case('leadership')
                                    @include('themes.default.sections.tabs.leadership', ['data' => $tab])
                                    @break
                                @case('location')
                                    @include('themes.default.sections.tabs.location', ['data' => $tab])
                                    @break
                                @case('rich_text')
                                    <div class="rich-text-content">
                                        {!! $tab['rich_content'] !!}
                                    </div>
                                    @break
                            @endswitch
                        </div>
                    </div>
                @endforeach

        </section>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const wrapper = document.getElementById('{{ $id }}');
                const buttons = wrapper.querySelectorAll('.tab-btn');
                const contents = wrapper.querySelectorAll('.tab-content');

                buttons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const targetId = this.getAttribute('data-tab');

                        // Update buttons
                        buttons.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');

                        // Update contents
                        contents.forEach(c => {
                            c.classList.remove('active');
                            c.style.display = 'none';
                            if (c.id === targetId + '-content') {
                                c.style.display = 'block';
                                setTimeout(() => c.classList.add('active'), 50);
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endif

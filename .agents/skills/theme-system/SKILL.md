---
name: laravel-theme-system
description: >
  Use this skill whenever the user wants to convert a static HTML template into a Laravel Blade-based
  multi-theme system, implement theme switching via database or Filament admin, organize frontend assets
  under public/themes, or build a CMS-ready page rendering system where page content (sections, blocks,
  components) is stored in the database and rendered dynamically through Blade templates.
  Trigger this skill for any of these phrases or scenarios: "convert HTML to Blade", "multi-theme Laravel",
  "theme switching from admin", "CMS page builder", "dynamic page content Laravel", "Filament theme manager",
  "public/themes asset structure", "page sections from database", or any combination of frontend theming
  + database-driven content in Laravel. Always use this skill even if the user only mentions one part of
  the system — theme assets, CMS blocks, or Filament integration.
---

# Laravel Theme System Skill

Transforms static HTML templates into a scalable, database-driven, multi-theme Blade system in Laravel,
with optional CMS page-rendering support for dynamic content blocks.

---

## Architecture Overview

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Frontend/PageController.php
│   └── Middleware/ThemeMiddleware.php
├── Models/
│   ├── Theme.php
│   ├── Page.php          ← CMS layer (optional)
│   └── PageSection.php   ← CMS layer (optional)
├── Services/
│   └── ThemeService.php

public/
└── themes/
    ├── default/
    │   ├── assets/
    │   │   ├── css/
    │   │   ├── js/
    │   │   └── images/
    │   └── screenshots/
    └── theme-two/
        └── assets/

resources/
└── views/
    ├── themes/
    │   ├── default/
    │   │   ├── layouts/
    │   │   │   └── master.blade.php
    │   │   ├── partials/
    │   │   │   ├── header.blade.php
    │   │   │   ├── footer.blade.php
    │   │   │   └── nav.blade.php
    │   │   └── pages/
    │   │       ├── home.blade.php
    │   │       ├── about.blade.php
    │   │       └── contact.blade.php
    │   └── theme-two/
    │       └── ... (same structure)
    └── cms/
        └── sections/     ← CMS block partials (optional)
            ├── hero.blade.php
            ├── features.blade.php
            └── cta.blade.php

database/
└── migrations/
    ├── create_themes_table.php
    ├── create_pages_table.php          ← CMS layer
    └── create_page_sections_table.php  ← CMS layer
```

---

## Step 1: Theme Asset Structure

All frontend assets must live inside `public/themes/{theme-slug}/assets/`.

**Never put theme-specific CSS/JS in `public/css` or `public/js`.**

```bash
mkdir -p public/themes/default/assets/{css,js,images}
mkdir -p public/themes/default/screenshots
```

In Blade, reference assets using:
```blade
<link rel="stylesheet" href="{{ theme_asset('css/style.css') }}">
<script src="{{ theme_asset('js/main.js') }}"></script>
```

---

## Step 2: Database Schema

### themes table
```php
Schema::create('themes', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();   // e.g., "default", "theme-two"
    $table->text('description')->nullable();
    $table->string('thumbnail')->nullable();
    $table->boolean('is_active')->default(false);
    $table->timestamps();
});
```

### Theme Model (app/Models/Theme.php)
```php
class Theme extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'thumbnail', 'is_active'];

    public static function active(): ?self
    {
        return static::where('is_active', true)->first();
    }

    public function activate(): void
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }
}
```

---

## Step 3: ThemeService

```php
// app/Services/ThemeService.php
class ThemeService
{
    protected ?Theme $theme = null;

    public function current(): Theme
    {
        if (!$this->theme) {
            $this->theme = Theme::active()
                ?? Theme::where('slug', 'default')->first()
                ?? throw new \RuntimeException('No active theme found.');
        }
        return $this->theme;
    }

    public function slug(): string
    {
        return $this->current()->slug;
    }

    public function assetUrl(string $path): string
    {
        return asset("themes/{$this->slug()}/assets/{$path}");
    }

    public function view(string $view): string
    {
        // e.g., "themes.default.pages.home"
        return "themes.{$this->slug()}.{$view}";
    }
}
```

Register in `AppServiceProvider`:
```php
$this->app->singleton(ThemeService::class);
```

---

## Step 4: Helper Function

```php
// app/helpers.php  (add to composer.json autoload files)
function theme_asset(string $path): string
{
    return app(\App\Services\ThemeService::class)->assetUrl($path);
}

function theme_view(string $view, array $data = []): \Illuminate\View\View
{
    return view(app(\App\Services\ThemeService::class)->view($view), $data);
}
```

`composer.json`:
```json
"autoload": {
    "files": ["app/helpers.php"]
}
```

---

## Step 5: Blade Layout Conversion

Convert static HTML into a Blade master layout:

```blade
{{-- resources/views/themes/default/layouts/master.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ theme_asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    @include(app(\App\Services\ThemeService::class)->view('partials.header'))

    <main>
        @yield('content')
    </main>

    @include(app(\App\Services\ThemeService::class)->view('partials.footer'))

    <script src="{{ theme_asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
```

Page view example:
```blade
{{-- resources/views/themes/default/pages/home.blade.php --}}
@extends(app(\App\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'Home')
@section('content')
    <section class="hero">
        <h1>Welcome</h1>
    </section>
@endsection
```

---

## Step 6: Controller & Routes

```php
// app/Http/Controllers/Frontend/PageController.php
class PageController extends Controller
{
    public function __construct(protected ThemeService $theme) {}

    public function home(): View
    {
        return theme_view('pages.home');
    }

    public function show(string $slug): View
    {
        // For CMS: fetch Page model by slug (see CMS section below)
        return theme_view('pages.' . $slug);
    }
}
```

```php
// routes/web.php
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
```

---

## Step 7: Filament Theme Switcher (Admin Panel)

```php
// app/Filament/Resources/ThemeResource.php
class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Textarea::make('description'),
            Toggle::make('is_active')
                ->label('Set as Active Theme')
                ->afterStateUpdated(function ($state, $record) {
                    if ($state && $record) {
                        $record->activate();
                    }
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
                IconColumn::make('is_active')->boolean(),
            ])
            ->actions([
                Action::make('activate')
                    ->label('Set Active')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (Theme $record) => $record->activate())
                    ->requiresConfirmation(),
            ]);
    }
}
```

---

## Step 8: Caching (Performance)

Cache the active theme to avoid DB hit on every request:

```php
// In ThemeService::current()
$this->theme = Cache::rememberForever('active_theme', fn () =>
    Theme::where('is_active', true)->first()
);

// Clear cache on theme activation:
// In Theme::activate()
Cache::forget('active_theme');
```

---

## CMS Layer (Future-Ready Page Content)

> Use this section when you want page content (hero text, sections, blocks) stored in the database
> and rendered dynamically through the theme templates.

### Database Schema

```php
// pages table
Schema::create('pages', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->boolean('is_published')->default(true);
    $table->timestamps();
});

// page_sections table
Schema::create('page_sections', function (Blueprint $table) {
    $table->id();
    $table->foreignId('page_id')->constrained()->cascadeOnDelete();
    $table->string('type');          // e.g., "hero", "features", "cta", "testimonials"
    $table->json('content');         // flexible content blob per section type
    $table->unsignedInteger('order')->default(0);
    $table->boolean('is_visible')->default(true);
    $table->timestamps();
});
```

### Content JSON Structure per Section Type

```json
// hero section
{
  "heading": "Welcome to Our Site",
  "subheading": "We build amazing things",
  "button_text": "Get Started",
  "button_url": "/contact",
  "background_image": "hero-bg.jpg"
}

// features section
{
  "title": "Our Features",
  "items": [
    { "icon": "star", "title": "Fast", "description": "Lightning quick" },
    { "icon": "shield", "title": "Secure", "description": "Bank-level security" }
  ]
}

// cta section
{
  "heading": "Ready to start?",
  "button_text": "Contact Us",
  "button_url": "/contact"
}
```

### Models

```php
// app/Models/Page.php
class Page extends Model
{
    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'is_published'];

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }
}

// app/Models/PageSection.php
class PageSection extends Model
{
    protected $fillable = ['page_id', 'type', 'content', 'order', 'is_visible'];
    protected $casts = ['content' => 'array'];
}
```

### CMS Controller

```php
// app/Http/Controllers/Frontend/PageController.php
public function show(string $slug): View
{
    $page = Page::where('slug', $slug)
        ->where('is_published', true)
        ->with('sections')
        ->firstOrFail();

    return theme_view('pages.dynamic', compact('page'));
}
```

### Dynamic Page Blade Template

```blade
{{-- resources/views/themes/default/pages/dynamic.blade.php --}}
@extends(app(\App\Services\ThemeService::class)->view('layouts.master'))

@section('title', $page->meta_title ?? $page->title)

@section('content')
    @foreach($page->sections->where('is_visible', true) as $section)
        @include('cms.sections.' . $section->type, ['content' => $section->content])
    @endforeach
@endsection
```

### Section Partials

```blade
{{-- resources/views/cms/sections/hero.blade.php --}}
<section class="hero-section">
    <h1>{{ $content['heading'] ?? '' }}</h1>
    <p>{{ $content['subheading'] ?? '' }}</p>
    @if(!empty($content['button_text']))
        <a href="{{ $content['button_url'] ?? '#' }}" class="btn">
            {{ $content['button_text'] }}
        </a>
    @endif
</section>

{{-- resources/views/cms/sections/features.blade.php --}}
<section class="features-section">
    <h2>{{ $content['title'] ?? '' }}</h2>
    <div class="features-grid">
        @foreach($content['items'] ?? [] as $item)
            <div class="feature-item">
                <span class="icon">{{ $item['icon'] }}</span>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['description'] }}</p>
            </div>
        @endforeach
    </div>
</section>
```

### Filament Page & Section Manager

```php
// PageResource with repeater for sections
Forms\Components\Repeater::make('sections')
    ->relationship()
    ->schema([
        Select::make('type')
            ->options([
                'hero'         => 'Hero Banner',
                'features'     => 'Features Grid',
                'cta'          => 'Call to Action',
                'testimonials' => 'Testimonials',
                'gallery'      => 'Gallery',
            ])
            ->required()
            ->reactive(),
        KeyValue::make('content')
            ->label('Section Content')
            ->reorderable(),
        TextInput::make('order')->numeric()->default(0),
        Toggle::make('is_visible')->default(true),
    ])
    ->orderColumn('order')
    ->collapsible()
    ->cloneable()
```

---

## Recommendations & Best Practices

### ✅ Do This
- Keep `cms/sections/` partials **theme-agnostic** — they provide structure/data, the theme CSS styles them
- Use `json` column for `content` so you can add new fields without migrations
- Cache pages: `Cache::tags(['pages'])->rememberForever("page:{$slug}", ...)`
- Add a `template` field to `pages` table for pages that need a custom Blade file instead of sections
- Validate `section->type` against an enum or config list to avoid missing partial errors

### ⚠️ Avoid
- Don't put business logic in Blade section partials — keep them as pure display
- Don't hardcode `theme_view()` paths in controllers — always go through `ThemeService`
- Don't share assets between themes — each theme must be fully self-contained

### 🚀 Scaling Tips
- Add a `pages.template` column: `"dynamic"` (section-based) or `"custom"` (direct Blade file)
- For complex content editors in Filament, use **Filament Curator** (media) + **Filament Spatie Media Library**
- When sections become complex, consider **Filament Flexible Content** or a custom JSON block builder
- Add `SEO` as a separate model/concern linked to `pages`

---

## Checklist

- [ ] `public/themes/{slug}/assets/` structure created
- [ ] `themes` table migrated, seeded with default theme
- [ ] `ThemeService` registered as singleton
- [ ] `theme_asset()` and `theme_view()` helpers available
- [ ] Static HTML broken into `layouts/master`, `partials/`, `pages/`
- [ ] Filament ThemeResource with activate action
- [ ] Active theme cache implemented
- [ ] (CMS) `pages` + `page_sections` tables migrated
- [ ] (CMS) `cms/sections/` partials created per section type
- [ ] (CMS) Filament PageResource with Repeater for sections
- [ ] (CMS) `PageController::show()` loads page with sections

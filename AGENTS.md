# AGENTS.md — University Modular CMS

> AI agents working on this project **must** read and follow every rule in this file before writing a single line of code.

---

## 🏗️ Stack (Non-Negotiable)

| Layer | Package | Version |
|---|---|---|
| PHP | `php` | `^8.3` |
| Framework | `laravel/framework` | `^13.0` |
| Admin Panel | `filament/filament` | `^5.0` |
| Modules | `nwidart/laravel-modules` | `^13.0` |
| RBAC | `bezhansalleh/filament-shield` | `^4.2` |
| Media | `filament/spatie-laravel-media-library-plugin` | `^5.0` |
| Queues | `laravel/horizon` | `^5.24` |
| Menu | `biostate/filament-menu-builder` | `^5.0` |
| Monitoring | `sentry/sentry-laravel` | `^4.0` |
| Testing | `pestphp/pest` | `^4.6` |
| Formatter | `laravel/pint` | `^1.27` |

> ❌ Do NOT add new packages without explicit user approval.
> ❌ Do NOT upgrade or downgrade any package version.

---

## 📦 Module Structure (STRICT — Never Deviate)

Every module **must** follow this exact directory structure:

```
Modules/{ModuleName}/
├── app/
│   ├── Models/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   ├── Services/              ← ALL business logic lives here
│   ├── Actions/               ← Single-responsibility actions
│   └── Filament/
│       └── Resources/
│           └── {Model}/
│               ├── {Model}Resource.php     ← Hook only, NO logic
│               ├── Pages/
│               │   ├── List{Models}.php
│               │   ├── Create{Model}.php
│               │   └── Edit{Model}.php
│               ├── Schemas/
│               │   └── {Model}Form.php     ← ALL form logic
│               ├── Tables/
│               │   └── {Model}Table.php    ← ALL table logic
│               └── RelationManagers/       ← optional
│                   └── {Related}RelationManager.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── {ModuleName}DatabaseSeeder.php
├── config/
├── tests/
├── composer.json
└── module.json
```

### Existing Modules

| Module | Purpose |
|---|---|
| `CMS` | Pages, Posts, Media content management |
| `Academic` | Faculty → Department → Program → Course hierarchy |
| `Theme` | Frontend theming and layout |

---

## 🚨 Core Architecture Rules

### 1. Filament is STRICTLY Module-Scoped
- ❌ **NEVER** create anything inside `app/Filament/`
- ✅ **ALWAYS** create resources inside `Modules/{Name}/app/Filament/`

### 2. Flexible Architectural Flow
- **Simple CRUD:** Filament Resource / Controller → Model (Permitted for basic Create/Read/Update/Delete)
- **Complex Business Logic:** Filament Resource / Controller → Service → Action → Model (Mandatory)
- ❌ NO heavy business logic or complex DB queries inside Resources, Schemas, Tables, or Blade templates
- ✅ Services handle all complex business logic, triggers, and multi-model operations
- ✅ Actions handle single-responsibility operations

### 3. Logic Isolation
- Filament `Resource.php` → delegates to Form and Table classes only
- `Schemas/{Model}Form.php` → form field definitions only
- `Tables/{Model}Table.php` → table column/filter/action definitions only
- `Services/` → required for all complex queries, mutations, and non-CRUD business rules

---

## 📄 File Templates

### Resource.php (Hook Only)

```php
<?php

namespace Modules\{ModuleName}\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\{ModuleName}\Filament\Resources\{Model}Resource\Pages;
use Modules\{ModuleName}\Filament\Resources\{Model}Resource\Schemas\{Model}Form;
use Modules\{ModuleName}\Filament\Resources\{Model}Resource\Tables\{Model}Table;
use Modules\{ModuleName}\Models\{Model};

class {Model}Resource extends Resource
{
    protected static ?string $model = {Model}::class;

    protected static \UnitEnum|string|null $navigationGroup = '{GroupName}';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-{icon}';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return {Model}Form::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return {Model}Table::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\List{Models}::route('/'),
            'create' => Pages\Create{Model}::route('/create'),
            'edit'   => Pages\Edit{Model}::route('/{record}/edit'),
        ];
    }
}
```

### Schemas/{Model}Form.php

```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class {Model}Form
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ]);
    }
}
```

**Rules:**
- `Schema` is `Filament\Schemas\Schema` — NOT `Filament\Forms\Form` (v5 change)
- Return `$schema->components([...])`
- Always import every component explicitly at the top

### Tables/{Model}Table.php

```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class {Model}Table
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
            ])
            ->filters([])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete()),
                ]),
            ]);
    }
}
```

**Rules:**
- Method name is `schema(Table $table): Table`
- ALWAYS explicitly import every Action, Column, Filter class
- NEVER use string class references inside methods

### Pages

```php
// List Page
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class List{Models} extends ListRecords
{
    protected static string $resource = {Model}Resource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}

// Create Page
use Filament\Resources\Pages\CreateRecord;

class Create{Model} extends CreateRecord
{
    protected static string $resource = {Model}Resource::class;
}

// Edit Page
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class Edit{Model} extends EditRecord
{
    protected static string $resource = {Model}Resource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
```

### Model

```php
<?php

namespace Modules\{ModuleName}\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {Model} extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
```

**Rules:**
- Standard auto-increment integer `id` — ❌ NO UUIDs
- Always define `$fillable`

### Service

```php
<?php

namespace Modules\{ModuleName}\Services;

use Modules\{ModuleName}\Models\{Model};

class {Model}Service
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return {Model}::query()->latest()->get();
    }

    public function create(array $data): {Model}
    {
        return {Model}::create($data);
    }

    public function update({Model} $model, array $data): {Model}
    {
        $model->update($data);
        return $model->fresh();
    }

    public function delete({Model} $model): void
    {
        $model->delete();
    }
}
```

---

## 🚨 Filament v5 Import Safety

| Context | Correct Namespace |
|---|---|
| Record actions (row buttons) | `Filament\Actions\*` |
| Bulk actions | `Filament\Actions\BulkAction`, `Filament\Actions\BulkActionGroup` |
| Grouping actions | `Filament\Actions\ActionGroup` |
| Pre-built actions (Edit/Delete/View) | `Filament\Actions\EditAction`, `Filament\Actions\DeleteAction`, `Filament\Actions\ViewAction` |
| Form components | `Filament\Forms\Components\*` |
| Schema class | `Filament\Schemas\Schema` |
| Table class | `Filament\Tables\Table` |
| Table Columns | `Filament\Tables\Columns\*` |
| Table Filters | `Filament\Tables\Filters\*` |


### Correct Action Usage in Tables (v5)

```php
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

public function table(Table $table): Table
{
    return $table
        ->recordActions([          // ← row-level actions
            ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]),
        ])
        ->toolbarActions([         // ← bulk actions go here
            BulkActionGroup::make([
                BulkAction::make('delete')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => $records->each->delete()),
            ]),
        ]);
}
```

---

## 🔐 RBAC — Filament Shield (Mandatory)

Every model **must** have a Policy. Permissions follow this naming:

```
view_any_{model}
view_{model}
create_{model}
update_{model}
delete_{model}
delete_any_{model}
```

Generate with:
```bash
php artisan shield:generate --all
```

---

## 🏫 University Domain Hierarchy

```
Faculty
  └── Department
        └── Program
              └── Course
```

Always respect this hierarchy in relationships, breadcrumbs, and navigation.

---

## 📁 Media (Spatie Media Library)

- Use `filament/spatie-laravel-media-library-plugin` for all file/image uploads
- Add `InteractsWithMedia` + `HasMedia` to models that need media
- Heavy uploads **must** be queued via Horizon

---

## ⚙️ Queue & Horizon Rules

Heavy tasks that **must** be queued:
- File uploads and media processing
- Email sending
- External API calls
- Report generation

```php
// Dispatch to specific queue
MyJob::dispatch($data)->onQueue('media');
```

---

## 🧭 Navigation Groups (Project-wide)

| Group | Resources |
|---|---|
| `Academic` | Faculties, Departments, Programs, Courses |
| `CMS` | Pages, Posts, Media |
| `Theme` | Menus, Layouts, Templates |
| `Settings` | System configuration, Roles, Permissions |

Icons: Heroicons v2 Outline — `heroicon-o-{name}`

---

## 🧪 Testing (Pest v4)

- Create tests: `php artisan make:test --pest {Name}Test`
- Run all: `php artisan test --compact`
- Run filtered: `php artisan test --compact --filter=testName`
- Use factories — never create models manually in tests
- Feature tests go in `tests/Feature/`, unit tests in `tests/Unit/`
- ❌ Do NOT delete existing tests without approval

```php
// Example feature test
it('can list faculties', function () {
    $faculty = Faculty::factory()->create();

    $response = $this->get(route('admin.academic.faculties.index'));

    $response->assertOk()->assertSee($faculty->name);
});
```

---

## 🖊️ PHP Code Standards

- PHP 8.3+ features — use constructor property promotion
- Always use explicit return types and type hints
- Always use curly braces for all control structures
- Enum keys in TitleCase: `ActiveStatus`, `PublishedState`
- Use PHPDoc blocks for complex types/array shapes
- Descriptive names: `isPublishedAndVisible()` not `check()`

---

## 🎨 Code Formatting

After **every** PHP file change, run:

```bash
vendor/bin/pint --dirty --format agent
```

> ❌ Never run `--test` flag. Always fix formatting, never just report it.

---

## 🗃️ Database & Migrations

- Use `php artisan make:migration` — never write raw SQL
- Always inspect table schema before writing models: `php artisan db:table {table}`
- Standard integer auto-increment IDs — no UUIDs
- Always add `$fillable` to models

---

## ⚡ Artisan Commands Reference

```bash
# Create a new module
php artisan module:make {Name}

# Create model with migration + factory + seeder
php artisan module:make-model {Model} {Module} --migration --factory --seed

# List all routes
php artisan route:list --except-vendor

# Run seeders
php artisan db:seed

# Refresh autoload
composer dump-autoload

# Generate Shield permissions
php artisan shield:generate --all

# Publish Spatie Media Library migrations
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
```

---

## ✅ Checklist Before Submitting Any Code

### New Resource
- [ ] Lives inside `Modules/{Name}/app/Filament/Resources/`
- [ ] `{Model}Resource.php` has NO business logic — delegates only
- [ ] `Schemas/{Model}Form.php` exists with `configure(Schema $schema): Schema`
- [ ] `Tables/{Model}Table.php` exists with `schema(Table $table): Table`
- [ ] All three pages exist: `List`, `Create`, `Edit`
- [ ] All imports are fully qualified and explicit
- [ ] `$navigationGroup`, `$navigationIcon`, `$navigationSort` are set
- [ ] Policy exists for the model
- [ ] Filament Shield permissions generated

### New Model
- [ ] Integer `id` (no UUID)
- [ ] `$fillable` defined
- [ ] Factory created
- [ ] Seeder created (`{ModuleName}DatabaseSeeder.php`)
- [ ] Migration created

### New Feature
- [ ] Service class created for business logic
- [ ] Action class created for single-responsibility operations
- [ ] Pest feature test written
- [ ] `vendor/bin/pint --dirty --format agent` run

---

## ❌ Hard Rules — Never Break These

1. **No global Filament** — everything inside modules
2. **No complex logic in Resources** — use Services for non-CRUD operations
3. **No UUIDs** — standard integer IDs only
4. **No new packages** — without user approval
5. **No string class references** — always use explicit imports
6. **No skipping Pint** — always format after PHP changes
7. **No deleting tests** — without user approval
8. **No direct complex DB queries in Filament layers** — use Service layer for non-trivial logic
9. **Schema is `Filament\Schemas\Schema`** — not `Filament\Forms\Form`
10. **Table actions from  `Filament\Actions\*`

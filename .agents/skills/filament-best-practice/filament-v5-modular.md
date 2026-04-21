---
name: filament-v5-modular
description: >
  Definitive architecture skill for generating Filament v5 resources inside
  nwidart/laravel-modules (Laravel 13, PHP 8.3+). Use this skill EVERY TIME
  the user asks to: create a Filament resource, make a new module, scaffold
  CRUD pages, define a form/table, add a RelationManager, or do anything
  involving Filament panels, schemas, or tables inside a modular Laravel
  project. Also trigger when the user uploads an HTML/design file and asks to
  turn it into Filament admin screens. Always follow this skill — never
  freestyle Filament v5 structure from memory.
---
 

---

## 1. Directory Layout (non-negotiable)

Every Filament resource lives in its **own named directory** inside the module.
Never put logic directly in `Resource.php`.

```
Modules/{ModuleName}/
├── app/
│   ├── Filament/
│   │   └── Resources/
│   │       └── {Model}Resource/
│   │           ├── {Model}Resource.php          ← Main hook only
│   │           ├── Pages/
│   │           │   ├── List{Models}.php
│   │           │   ├── Create{Model}.php
│   │           │   └── Edit{Model}.php
│   │           ├── RelationManagers/             ← optional
│   │           │   └── {Related}RelationManager.php
│   │           ├── Schemas/
│   │           │   └── {Model}Form.php           ← ALL form logic here
│   │           └── Tables/
│   │               └── {Model}Table.php          ← ALL table logic here
│   ├── Models/
│   │   └── {Model}.php
│   └── Providers/
│       └── {ModuleName}ServiceProvider.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── {ModuleName}DatabaseSeeder.php        ← auto-detected
└── module.json
```

---

when create a module then 1st command for this then update everything 
##Scaffold a new module
php artisan module:make {Name}


## 2. Resource.php — Main Hook Only

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

    // ── Navigation ──────────────────────────────────────────────────────────
    protected static \UnitEnum|string|null $navigationGroup = '{GroupName}';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-{icon}';
    protected static ?int $navigationSort = 1;

    // ── Schema (Form) ────────────────────────────────────────────────────────
    public static function form(Schema $schema): Schema
    {
        return {Model}Form::configure($schema);
    }

    // ── Table ────────────────────────────────────────────────────────────────
    public static function table(Table $table): Table
    {
        return {Model}Table::schema($table);
    }

    // ── Pages ────────────────────────────────────────────────────────────────
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

---

## 3. Schema (Form) Standard

File: `Schemas/{Model}Form.php`

```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class {Model}Form
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            // Add more components as needed
        ]);
    }
}
```

**Rules:**
- Always import every component at the top. No inline class strings.
- `Schema` is from `Filament\Schemas\Schema` (v5), NOT `Filament\Forms\Form`.
- Return `$schema->components([...])`.

---

## 4. Table Standard

File: `Tables/{Model}Table.php`

```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class {Model}Table
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                // Add more columns as needed
            ])
            ->filters([
                // Add filters as needed
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
```

**Rules:**
- ALWAYS explicitly import every `Action`, `Column`, `Filter` class.
- NEVER use string references like `Tables\Actions\EditAction` inside methods.
- Method name is `schema(Table $table): Table`.

---

## 5. Pages Standard

### List Page
```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\{ModuleName}\Filament\Resources\{Model}Resource;

class List{Models} extends ListRecords
{
    protected static string $resource = {Model}Resource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
```

### Create Page
```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\{ModuleName}\Filament\Resources\{Model}Resource;

class Create{Model} extends CreateRecord
{
    protected static string $resource = {Model}Resource::class;
}
```

### Edit Page
```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\{ModuleName}\Filament\Resources\{Model}Resource;

class Edit{Model} extends EditRecord
{
    protected static string $resource = {Model}Resource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
```

---

## 6. Model Standard

```php
<?php

namespace Modules\{ModuleName}\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {Model} extends Model
{
    use HasFactory;

    // Standard integer IDs — NO UUIDs
    protected $fillable = [
        'name',
        // ...
    ];
}
```

**Rules:**
- Standard auto-increment integer `id`. **No UUIDs.**
- Always define `$fillable`.

---

## 7. Navigation Groups (Project-wide Consistency)

| Group Name | Purpose |
|---|---|
| `Catalog` | Products, Brands, Categories |
| `Inventory` | Stock, Warehouses |
| `Sales` | Orders, Invoices, Customers |
| `Academic` | Courses, Departments, Faculties |
| `HR` | Staff, Roles, Attendance |
| `Settings` | System configuration |

Use Heroicons v2 Outline names: `heroicon-o-{name}`.

---

## 8. Navigation Sort Convention

Each resource sets `$navigationSort` so the panel menu stays organized:

```php
protected static ?int $navigationSort = 1; // First item in its group
```

---

## 9. RelationManager (when needed)

```php
<?php

namespace Modules\{ModuleName}\Filament\Resources\{Model}Resource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class {Related}RelationManager extends RelationManager
{
    protected static string $relationship = '{relationshipName}';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            // form fields
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()]);
    }
}
```

Register in `Resource.php`:
```php
public static function getRelations(): array
{
    return [
        RelationManagers\{Related}RelationManager::class,
    ];
}
```

---

## 10. Seeder Standard

File: `database/seeders/{ModuleName}DatabaseSeeder.php`

```php
<?php

namespace Modules\{ModuleName}\Database\Seeders;

use Illuminate\Database\Seeder;

class {ModuleName}DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed logic
    }
}
```

Auto-detected by root `DatabaseSeeder.php` — no manual registration needed.

---

## 11. Automated System Rules (never break these)

1. **Auto-Discovery**: `AdminPanelProvider.php` scans `Modules/*/app/Filament/Resources` — new resources register automatically.
2. **Auto-Seeding**: Root `DatabaseSeeder.php` finds all `*DatabaseSeeder.php` inside modules automatically.
3. **PSR-4**: In `composer.json`, map `Database\Seeders` and `Database\Factories` **before** the general module path.

---

## 12. Useful Artisan Commands

```bash
# Scaffold a new module
php artisan module:make {Name}

# Refresh autoload after adding classes
composer dump-autoload

# Run all seeders
php artisan db:seed

# Publish Spatie Media Library migrations
php artisan vendor:publish \
  --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" \
  --tag="medialibrary-migrations"
```

---

## 13. Checklist When Creating Any Resource

- [ ] Module directory exists (`Modules/{Name}/`)
- [ ] `{Model}Resource.php` delegates to Form and Table classes (no logic inside)
- [ ] `Schemas/{Model}Form.php` exists with `configure(Schema $schema): Schema`
- [ ] `Tables/{Model}Table.php` exists with `schema(Table $table): Table`
- [ ] All pages exist: `List`, `Create`, `Edit`
- [ ] All imports are explicit (no string class references)
- [ ] `$navigationGroup`, `$navigationIcon`, `$navigationSort` defined
- [ ] Model uses integer ID (no UUID)
- [ ] `$fillable` defined on model
- [ ] Seeder file named `{ModuleName}DatabaseSeeder.php`
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

## 1. Directory Layout (non-negotiable)

Every Filament resource lives in its **own named directory** inside the module.
Never put logic directly in `Resource.php`. Use the `app` subdirectory for classes.

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
├── database/                                     ← Lowercase as per standard
│   ├── migrations/
│   └── seeders/
│       └── {ModuleName}DatabaseSeeder.php        ← Correct Namespace: Modules\{ModuleName}\Database\Seeders
└── module.json
```

---

## 2. Resource.php — Main Hook Only

```php
<?php

namespace Modules\{ModuleName}\app\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\{ModuleName}\app\Filament\Resources\{Model}Resource\Pages;
use Modules\{ModuleName}\app\Filament\Resources\{Model}Resource\Schemas\{Model}Form;
use Modules\{ModuleName}\app\Filament\Resources\{Model}Resource\Tables\{Model}Table;
use Modules\{ModuleName}\app\Models\{Model};

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

File: `app/Filament/Resources/{Model}Resource/Schemas/{Model}Form.php`

```php
<?php

namespace Modules\{ModuleName}\app\Filament\Resources\{Model}Resource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class {Model}Form
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(['lg' => 12])
                ->schema([
                    Group::make([
                        Section::make('Main Content')
                            ->schema([
                                TextInput::make('name')->required(),
                                // Other fields
                            ]),
                    ])->columnSpan(['lg' => 8]),

                    Group::make([
                        Section::make('Status')
                            ->schema([
                                // Sidebar fields
                            ]),
                    ])->columnSpan(['lg' => 4]),
                ]),
        ]);
    }
}
```

**Rules:**
- `Schema` is from `Filament\Schemas\Schema` (v5), NOT `Filament\Forms\Form`.
- Use the **12-column system** (`columns(12)`) for complex layouts.
- Prefer `columnSpan(['lg' => X])` for responsive behavior.

---

## 4. Table Standard

File: `app/Filament/Resources/{Model}Resource/Tables/{Model}Table.php`

```php
<?php

namespace Modules\{ModuleName}\app\Filament\Resources\{Model}Resource\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class {Model}Table
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
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

---

## 5. Pages Standard (Full Width Control)

All CRUD pages should ideally override `getMaxContentWidth` to return `\Filament\Support\Enums\Width::Full`.

```php
namespace Modules\{ModuleName}\app\Filament\Resources\{Model}Resource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\{ModuleName}\app\Filament\Resources\{Model}Resource;
use Filament\Support\Enums\Width;

class List{Models} extends ListRecords
{
    protected static string $resource = {Model}Resource::class;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}
```

---

## 6. PSR-4 and Seeder Rules

1. **Composer.json**: You MUST add explicit mappings for module database directories to the root `composer.json` to avoid autoloading warnings:
   ```json
   "Modules\\{ModuleName}\\Database\\Seeders\\": "Modules/{ModuleName}/database/seeders/",
   "Modules\\{ModuleName}\\Database\\factories\\": "Modules/{ModuleName}/database/factories/",
   ```
2. **Seeder Namespace**: `Modules\{ModuleName}\Database\Seeders`.
3. **Seeder Path**: `Modules/{ModuleName}/database/seeders/{ModuleName}DatabaseSeeder.php` (note lowercase `database`).

---

## 7. Automated System Rules (never break these)

1. **Auto-Discovery**: `AdminPanelProvider.php` scans `Modules/*/app/Filament/Resources` automatically.
2. **Standard IDs**: Use auto-incrementing integers for models. NO UUIDs.
3. **Implicit Logic**: No business logic in `Resource.php`, `Form.php`, or `Table.php`. Keep them declarative.
4. **Imports**: ALWAYS explicitly import every Filament component, action, and enum used.

---

## 13. Resource Checklist

- [ ] Module has `app/` prefix for all class namespaces.
- [ ] `PageResource.php` uses correct v5 type hints for navigation properties.
- [ ] `PageResource.php` form/table methods use `Schema` and `Table` classes.
- [ ] CRUD Pages override `getMaxContentWidth()` to return `Width::Full`.
- [ ] `composer.json` contains PSR-4 mappings for module database folders.
- [ ] All components are explicitly imported at the top of the file.

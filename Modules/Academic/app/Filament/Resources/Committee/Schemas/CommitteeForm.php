<?php

namespace Modules\Academic\app\Filament\Resources\Committee\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CommitteeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Textarea::make('description')
                ->columnSpanFull(),

            Toggle::make('is_active')
                ->default(true),

            Repeater::make('members')
                ->relationship('members')
                ->reorderable('sort_order')
                ->defaultItems(0)
                ->schema([
                    Select::make('faculty_member_id')
                        ->relationship('facultyMember', 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(fn ($state, $set) => $state ? $set('name', null) : null),

                    TextInput::make('name')
                        ->label('Name (if not faculty)')
                        ->maxLength(255)
                        ->hidden(fn ($get) => $get('faculty_member_id')),

                    TextInput::make('designation')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true),

                    Toggle::make('is_active')
                        ->default(true),
                ])
                ->itemLabel(function (array $state): ?string {
                    $name = $state['name'] ?? null;
                    if (! $name && ($state['faculty_member_id'] ?? null)) {
                        $name = \Modules\Academic\app\Models\FacultyMember::find($state['faculty_member_id'])?->name;
                    }
                    
                    $designation = $state['designation'] ?? null;
                    
                    return $name 
                        ? ($designation ? "{$name} - {$designation}" : $name)
                        : null;
                })
                ->columns(2)
                ->columnSpanFull()
                ->collapsible(),
        ]);
    }
}

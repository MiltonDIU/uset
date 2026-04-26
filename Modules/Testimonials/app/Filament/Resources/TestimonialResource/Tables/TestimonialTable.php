<?php

namespace Modules\Testimonials\app\Filament\Resources\TestimonialResource\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;

class TestimonialTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('designation')
                    ->searchable(),

                TextColumn::make('testimonialable_type')
                    ->label('Linked To')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$state) return 'None';
                        $shortName = class_basename($state);
                        $targetName = $record->testimonialable?->name ?? 'Unknown';
                        return "{$shortName}: {$targetName}";
                    }),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                IconColumn::make('is_featured_on_home')
                    ->boolean()
                    ->label('Home'),

                TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // 
            ]);
    }
}

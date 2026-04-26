<?php

namespace Modules\FAQ\app\Filament\Resources\FaqResource\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;

class FaqTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('category.name')
                    ->sortable()
                    ->badge(),

                TextColumn::make('faqable_type')
                    ->label('Linked To')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$state) return 'General';
                        $shortName = class_basename($state);
                        return "{$shortName}: {$record->faqable?->name}";
                    })
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('faq_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->reorderable('sort_order');
    }
}

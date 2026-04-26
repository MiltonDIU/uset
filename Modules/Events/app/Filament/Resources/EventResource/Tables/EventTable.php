<?php

namespace Modules\Events\app\Filament\Resources\EventResource\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class EventTable
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('banner')
                    ->collection('banner')
                    ->square(),

                SpatieMediaLibraryImageColumn::make('gallery')
                    ->collection('gallery')
                    ->stacked()
                    ->limit(3)
                    ->circular()
                    ->toggleable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('event_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('venue')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Upcoming' => 'info',
                        'Running' => 'warning',
                        'Completed' => 'success',
                        'Cancelled' => 'danger',
                    }),

                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Feat'),

                TextColumn::make('category.name')
                    ->badge()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('event_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                
                SelectFilter::make('status')
                    ->options([
                        'Upcoming' => 'Upcoming',
                        'Running' => 'Running',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ]),
            ])
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

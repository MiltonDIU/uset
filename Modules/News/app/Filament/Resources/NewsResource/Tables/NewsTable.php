<?php

namespace Modules\News\app\Filament\Resources\NewsResource\Tables;

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

class NewsTable
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->circular(),

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

                TextColumn::make('category.name')
                    ->badge()
                    ->sortable(),

                TextColumn::make('faculty.name')
                    ->placeholder('N/A')
                    ->toggleable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'pending' => 'warning',
                        'draft' => 'gray',
                    }),

                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Feat')
                    ->toggleable(),

                IconColumn::make('is_pinned')
                    ->boolean()
                    ->label('Pin')
                    ->toggleable(),

                IconColumn::make('is_breaking')
                    ->boolean()
                    ->label('Break')
                    ->toggleable(),

                TextColumn::make('news_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('news_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'pending' => 'Pending Approval',
                        'published' => 'Published',
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

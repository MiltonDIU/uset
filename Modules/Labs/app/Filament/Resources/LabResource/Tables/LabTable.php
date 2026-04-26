<?php

namespace Modules\Labs\app\Filament\Resources\LabResource\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;

class LabTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('gallery')
                    ->collection('gallery')
                    ->limit(1)
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('labbable_type')
                    ->label('Owner')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$state) return 'General';
                        $shortName = class_basename($state);
                        $targetName = $record->labbable?->name ?? 'Unknown';
                        return "{$shortName}: {$targetName}";
                    }),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

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

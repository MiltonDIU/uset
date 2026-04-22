<?php

namespace Modules\Academic\app\Filament\Resources\Program\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Academic\app\Enums\ActiveStatus;

class ProgramTable
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('department.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('programType.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('duration')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_semester')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (ActiveStatus $state): string => $state->getLabel())
                    ->color(fn (ActiveStatus $state): string => $state->getColor())
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->relationship('department', 'name'),
                SelectFilter::make('programType')
                    ->relationship('programType', 'name'),
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filter')
                    ->slideOver(),
            )
            ->columnManager()
            ->columnManagerTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Column')
                    ->slideOver(),
            )
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

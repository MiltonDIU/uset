<?php

namespace Modules\Academic\app\Filament\Resources\FacultyMember\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Modules\Academic\app\Enums\ActiveStatus;

class FacultyMemberTable
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                SpatieMediaLibraryImageColumn::make('profile_picture')
                    ->collection('profile_pictures')
                    ->circular(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('designation')->searchable()->sortable(),
                TextColumn::make('department.name')->searchable()->sortable(),
                TextColumn::make('researchInterests.name')
                    ->badge()
                    ->searchable(),
                TextColumn::make('email')->searchable()->toggleable(),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (ActiveStatus $state): string => $state->getLabel())
                    ->color(fn (ActiveStatus $state): string => $state->getColor())
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->label('Department')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options(ActiveStatus::class),
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

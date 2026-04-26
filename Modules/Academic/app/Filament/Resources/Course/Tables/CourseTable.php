<?php

namespace Modules\Academic\app\Filament\Resources\Course\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Modules\Academic\app\Enums\ActiveStatus;

class CourseTable
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Course code copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('program.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('credits')
                    ->numeric()
                    ->sortable()
                    ->alignment('center'),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'core' => 'primary',
                        'elective' => 'info',
                        'ged' => 'warning',
                        'lab' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('semester_level')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (ActiveStatus $state): string => $state->getLabel())
                    ->color(fn (ActiveStatus $state): string => $state->getColor())
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('type')
                    ->options([
                        'core' => 'Core',
                        'elective' => 'Elective',
                        'ged' => 'GED',
                        'lab' => 'Lab',
                    ]),

                SelectFilter::make('semester_level')
                    ->options([
                        'Year 1' => 'Year 1',
                        'Year 2' => 'Year 2',
                        'Year 3' => 'Year 3',
                        'Year 4' => 'Year 4',
                    ]),

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

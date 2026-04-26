<?php

namespace Modules\Academic\app\Filament\Resources\AcademicEvent\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class AcademicEventTable
{
    public static function schema(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('session.name')
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_holiday')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('academic_session_id')
                    ->relationship('session', 'name')
                    ->label('Session'),
                SelectFilter::make('type')
                    ->options([
                        'event' => 'Event',
                        'holiday' => 'Holiday',
                        'exam' => 'Exam',
                        'admission' => 'Admission',
                        'registration' => 'Registration',
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

<?php

namespace Modules\Social\app\Filament\Resources\SocialLinkResource\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;

class SocialLinkTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('platform')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('url')
                    ->limit(50)
                    ->searchable(),

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
            ->reorderable('sort_order')
            ->defaultSort('sort_order');
    }
}

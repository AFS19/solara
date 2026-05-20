<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('spf_value')
                    ->label('SPF')
                    ->sortable(),
                TextColumn::make('skin_type')
                    ->sortable(),
                ColorColumn::make('color_hex')
                    ->label('Color'),
                ToggleColumn::make('is_featured')
                    ->label('Featured'),
                TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('spf_value')
                    ->options([
                        '15' => 'SPF 15',
                        '30' => 'SPF 30',
                        '50' => 'SPF 50',
                        '50+' => 'SPF 50+',
                    ]),
                SelectFilter::make('skin_type')
                    ->options([
                        'all' => 'All Skin Types',
                        'sensitive' => 'Sensitive',
                        'oily' => 'Oily',
                        'dry' => 'Dry',
                        'combination' => 'Combination',
                    ]),
                Filter::make('is_featured')
                    ->query(fn (Builder $query) => $query->where('is_featured', true))
                    ->label('Featured Only'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }
}

<?php

namespace App\Filament\Resources\Offers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OffersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('provider_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('offer_code')
                    ->searchable(),
                TextColumn::make('brand')
                    ->searchable(),
                TextColumn::make('product_type'),
                TextColumn::make('currency')
                    ->searchable(),
                TextColumn::make('rrso')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('amount_min')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('amount_max')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('term_min_months')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('term_max_months')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('interest_type'),
                TextColumn::make('monthly_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('setup_fee')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('bik_check')
                    ->boolean(),
                TextColumn::make('payout_speed'),
                IconColumn::make('first_loan_free')
                    ->boolean(),
                TextColumn::make('eligibility_notes')
                    ->searchable(),
                TextColumn::make('annual_fee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('grace_days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cashback_pct')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('welcome_bonus')
                    ->searchable(),
                TextColumn::make('insurance_kind'),
                TextColumn::make('premium_from')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tracking_url')
                    ->searchable(),
                TextColumn::make('status'),
                TextColumn::make('source')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

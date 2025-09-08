<?php

namespace App\Filament\Resources\Offers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OfferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('provider_id')
                    ->required()
                    ->numeric(),
                TextInput::make('offer_code'),
                TextInput::make('brand')
                    ->required(),
                Select::make('product_type')
                    ->options(['loan' => 'Loan', 'card' => 'Card', 'insurance' => 'Insurance'])
                    ->required(),
                TextInput::make('currency')
                    ->required()
                    ->default('PLN'),
                TextInput::make('rrso')
                    ->numeric(),
                TextInput::make('amount_min')
                    ->required()
                    ->numeric()
                    ->default(100),
                TextInput::make('amount_max')
                    ->required()
                    ->numeric()
                    ->default(5000),
                TextInput::make('term_min_months')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('term_max_months')
                    ->required()
                    ->numeric()
                    ->default(12),
                Select::make('interest_type')
                    ->options(['annuity' => 'Annuity', 'flat' => 'Flat', 'promo_zero' => 'Promo zero', 'other' => 'Other'])
                    ->default('annuity')
                    ->required(),
                TextInput::make('monthly_rate')
                    ->numeric(),
                TextInput::make('setup_fee')
                    ->numeric(),
                Toggle::make('bik_check')
                    ->required(),
                Select::make('payout_speed')
                    ->options(['instant' => 'Instant', 'same_day' => 'Same day', '1_3_days' => '1 3 days', 'other' => 'Other']),
                Toggle::make('first_loan_free')
                    ->required(),
                TextInput::make('eligibility_notes'),
                TextInput::make('annual_fee')
                    ->numeric(),
                TextInput::make('grace_days')
                    ->numeric(),
                TextInput::make('cashback_pct')
                    ->numeric(),
                TextInput::make('welcome_bonus'),
                Select::make('insurance_kind')
                    ->options([
            'oc' => 'Oc',
            'ac' => 'Ac',
            'travel' => 'Travel',
            'health' => 'Health',
            'property' => 'Property',
            'other' => 'Other',
        ]),
                TextInput::make('premium_from')
                    ->numeric(),
                TextInput::make('tracking_url'),
                Select::make('status')
                    ->options(['active' => 'Active', 'hidden' => 'Hidden', 'archived' => 'Archived'])
                    ->default('active')
                    ->required(),
                TextInput::make('source'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Providers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProviderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Select::make('network')
                    ->options([
            'awin' => 'Awin',
            'admitad' => 'Admitad',
            'cju' => 'Cju',
            'direct' => 'Direct',
            'other' => 'Other',
        ])
                    ->default('other')
                    ->required(),
                TextInput::make('website_url'),
                TextInput::make('tracking_template'),
                Select::make('status')
                    ->options(['active' => 'Active', 'paused' => 'Paused'])
                    ->default('active')
                    ->required(),
            ]);
    }
}

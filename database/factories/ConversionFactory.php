<?php

namespace Database\Factories;

use App\Models\Conversion;
use App\Models\Click;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversionFactory extends Factory
{
    protected $model = Conversion::class;

    public function definition(): array
    {
        return [
            'click_id'    => Click::factory(),
            'status'      => 'approved',
            'payout'      => 10.00,
            'currency'    => 'PLN',
            'external_id' => $this->faker->uuid(),
        ];
    }
}

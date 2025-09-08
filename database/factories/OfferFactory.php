<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition(): array
    {
        $provider = Provider::factory()->create();

        return [
            'provider_id'      => $provider->id,
            'offer_code'       => 'OFR'.$this->faker->unique()->numberBetween(1, 999),
            'brand'            => $this->faker->company(),
            'product_type'     => $this->faker->randomElement(['loan','card','insurance']),
            'currency'         => 'PLN',
            'rrso'             => $this->faker->randomFloat(2, 1, 30),

            'amount_min'       => 100,
            'amount_max'       => 100000,
            'term_min_months'  => 1,
            'term_max_months'  => 120,

            // IMPORTANT: match your DB enum
            'interest_type'    => $this->faker->randomElement(['annuity','flat','promo_zero','other']),
            'monthly_rate'     => $this->faker->randomFloat(2, 0, 5),
            'setup_fee'        => $this->faker->randomFloat(2, 0, 100),
            'bik_check'        => $this->faker->boolean ? 1 : 0,

            // If you have an enum here, keep it to the allowed set
            'payout_speed'     => $this->faker->randomElement(['instant','same_day','1_3_days']),
            'first_loan_free'  => 0,
            'eligibility_notes'=> null,

            // Card-only (nullable otherwise)
            'annual_fee'       => null,
            'grace_days'       => null,
            'cashback_pct'     => null,
            'welcome_bonus'    => null,

            // Insurance-only (nullable otherwise)
            'insurance_kind'   => null,
            'premium_from'     => null,

            // The controller replaces these tokens
            'tracking_url'     => 'https://t.example/click?cid={CLICK_ID}&sub={SUBID}&a={AMOUNT}&t={TERM}',
            'status'           => 'active',
            'source'           => 'factory',
        ];
    }

    public function loan(): self
    {
        return $this->state(fn () => [
            'product_type'  => 'loan',
            'annual_fee'    => null,
            'grace_days'    => null,
            'insurance_kind'=> null,
            'premium_from'  => null,
        ]);
    }

    public function card(): self
    {
        return $this->state(fn () => [
            'product_type' => 'card',
            'annual_fee'   => $this->faker->numberBetween(0, 300),
            'grace_days'   => $this->faker->numberBetween(20, 56),
        ]);
    }

    public function insurance(): self
    {
        return $this->state(fn () => [
            'product_type'  => 'insurance',
            'insurance_kind'=> $this->faker->randomElement(['oc','ac','nnw','travel']),
            'premium_from'  => $this->faker->numberBetween(10, 200),
            'annual_fee'    => null,
            'grace_days'    => null,
        ]);
    }
}

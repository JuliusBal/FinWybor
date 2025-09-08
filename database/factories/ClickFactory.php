<?php

namespace Database\Factories;

use App\Models\Click;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClickFactory extends Factory
{
    protected $model = Click::class;

    public function definition(): array
    {
        $offer = Offer::factory()->create();

        return [
            'click_uuid'  => (string) Str::uuid(),
            'offer_id'    => $offer->id,
            'provider_id' => $offer->provider_id, // FK used by conversions
            'amount'      => 3000,
            'term_months' => 6,
            'user_agent'  => 'Mozilla/5.0 (Test)',
            'ip_hash'     => hash('sha256', '127.0.0.1'),
            'referer'     => 'http://localhost/test',
        ];
    }
}

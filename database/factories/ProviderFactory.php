<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name'              => $name,
            'slug'              => Str::slug($name.'-'.$this->faker->unique()->word()),
            'network'           => $this->faker->randomElement(['awin','admitad','cju','direct','other']),
            'website_url'       => 'https://example.com',
            'tracking_template' => 'https://t.example.com/?click_id={CLICK_ID}',
            'status'            => 'active',
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'start' => $this->faker->dateTimeBetween('-1 month', '+1 week'),
            'end' => $this->faker->dateTimeBetween('+1 week', '+6 months'),
        ];
    }
}

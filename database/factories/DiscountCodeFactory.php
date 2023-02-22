<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\DiscountCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountCodeFactory extends Factory
{
    protected $model = DiscountCode::class;

    public function definition()
    {
        return [
            'campaign_id' => Campaign::inRandomOrder()->first(),
            'code' => $this->faker->unique()->text(10),
            'discount_rate' => $this->faker->randomElement([10, 20, 30]),
            'expire_date' => $this->faker->dateTimeBetween('+1 week', '+1 year')
        ];
    }
}
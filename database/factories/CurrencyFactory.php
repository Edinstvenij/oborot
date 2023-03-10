<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => '840',
            'cipher' => 'USD',
            'name' => 'Доллар США',
            'course' => null,
            'remainder' => $this->faker->randomNumber(rand(3, 5))
        ];
    }
}

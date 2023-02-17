<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RemainderDay>
 */
class RemainderDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cipher' => 'USD',
            'remainder' => $this->faker->randomNumber(5),
            'date' => ''
        ];
    }
}

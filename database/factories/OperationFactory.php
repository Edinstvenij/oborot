<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operation>
 */
class OperationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $operation = rand(0, 1);

        if ($operation) {
            //  Bay and Sale

            return [
                'name' => $this->faker->randomElement(['buy', 'sale']),
                'currency_cipher' => 'USD',
                'currency_cipher_donor' => 'UAH',
                'course' => $this->faker->randomFloat(2, 10, 48),
                'sum' => $this->faker->numberBetween(500, 3000),
                'sum_donor' => $this->faker->numberBetween(2000, 23000),
                'date' => $this->faker->dateTimeBetween('-1 week'),
            ];
        }

        //  Expenses and Parishes
        return [
            'name' => $this->faker->randomElement(['expenses', 'parishes']),
            'currency_cipher' => 'USD',
            'sum' => $this->faker->numberBetween(100, 1000),
            'comment' => $this->faker->words(rand(1, 7), true),
            'date' => $this->faker->dateTimeBetween('-1 week'),
        ];
    }
}

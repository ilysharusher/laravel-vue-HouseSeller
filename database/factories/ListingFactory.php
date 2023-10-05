<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area' => fake()->numberBetween(30, 1_000),
            'beds' => fake()->numberBetween(1, 5),
            'baths' => fake()->numberBetween(1, 8),

            'city' => fake()->city,
            'street' => fake()->streetName,
            'street_number' => fake()->buildingNumber,
            'code' => fake()->postcode,

            'price' => fake()->numberBetween(10_000, 100_000_000),
        ];
    }
}

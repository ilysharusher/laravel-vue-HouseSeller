<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class StoreListingRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'beds' => $this->faker->numberBetween(1, 300),
            'baths' => $this->faker->numberBetween(1, 300),
            'area' => $this->faker->numberBetween(1, 50000),
            'city' => $this->faker->city,
            'code' => $this->faker->postcode,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'price' => $this->faker->numberBetween(100, 1000000000),
        ];
    }
}

<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class RegisterRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }
}

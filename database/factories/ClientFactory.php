<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name' => $this->faker->name(),
            'address1' => $this->faker->streetName(),
            'address2' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'latitude' => $this->faker->randomFloat(6, -100, 100),
            'longitude' => $this->faker->randomFloat(6, -100, 100),
            'phone_no1' => $this->faker->phoneNumber(),
            'phone_no2' => $this->faker->e164PhoneNumber(),
            'zip' => $this->faker->postcode(),
            'start_validity' => now(),
            'end_validity' => now()->addDays(15),
            'status' => Client::ACTIVE,
        ];
    }
}

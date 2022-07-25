<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realTextBetween(25,45),
            'description' => $this->faker->realTextBetween(100,150),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'price' => rand(500, 5000)*1000,
            'sqm' => rand(150, 1500),
            'bedrooms' => rand(3, 10),
            'bathrooms' => rand(3, 6),
            'garages' => rand(1, 5),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parcel>
 */
class ParcelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parcel_number' => $this->faker->regexify('([a-z]|[A-Z]|[0-9]){10}'),
            'size' => $this->faker->randomElement(['S', 'M','L','XL']),
            
        ];
    }
}

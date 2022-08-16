<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActivatedProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id'=>fake()->randomDigitNotZero(),
            'is_activated'=>fake()->boolean(),
            'activation_allowed'=>fake()->numberBetween(1,20),
            'activation_done'=>fake()->numberBetween(1,20),
            'activation_key'=>fake()->randomElement(["123","abc"]),
            'expiry_date_time'=>fake()->dateTime(),
            'customer_id'=>fake()->randomDigitNotZero(),
        ];
    }
}

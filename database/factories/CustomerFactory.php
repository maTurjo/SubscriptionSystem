<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model=Customer::class;

    public function definition()
    {
        return [
            'name'=>fake()->name(),
            'email'=>fake()->email(),
            'password'=>bcrypt("123456789"),
            'rememberToken'=>fake()->regexify('[A-Za-z0-9]{20}'),
            'isAdmin' => false,

        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Chronicles of' . fake()->name,
            'isbn' =>  fake()->isbn13(),
            'value' => fake()->numberBetween(1000, 1000000),
            'image' => fake()->imageUrl()
        ];
    }
}

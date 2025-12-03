<?php

namespace Database\Factories;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fee>
 */
class FeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return RuleFactory::make([
            '%name%' => $this->faker->word,
            '%description%' => $this->faker->sentence,
            'price' => rand(0, 100),
            'active' => $this->faker->boolean,
        ]);
    }
}

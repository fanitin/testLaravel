<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Result;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    protected $model = Result::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kwota' => fake()->numberBetween(0, 1000000),
            'years' => fake()->numberBetween(1, 20),
            'procent' => fake()->numberBetween(0, 15),
            'wynik' => function (array $attributes) {
                $result = ($attributes['kwota'] + ($attributes['kwota'] * $attributes['procent'] / 100)) / ($attributes['years'] * 12);
                return ceil($result * 100) / 100;
            },
            'phone' => fake()->regexify('/^\+48[0-9]{9}$/'),
            'category_id' => Category::get()->random()->id
        ];
    }
}

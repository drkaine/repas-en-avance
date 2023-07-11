<?php

declare(strict_types = 1);

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$faker = new Generator;

		return [
			'id_recette' => $faker->randomNumber(1),
			'id_tag' => $faker->randomNumber(1),
			'quantite' => $faker->randomNumber(1),
		];
	}
}

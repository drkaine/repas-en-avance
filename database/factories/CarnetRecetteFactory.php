<?php

declare(strict_types = 1);

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarnetRecette>
 */
class CarnetRecetteFactory extends Factory
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
			'id_user' => $faker->randomNumber(1),
			'id_recette' => $faker->randomNumber(1),
		];
	}
}

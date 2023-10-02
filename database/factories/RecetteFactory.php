<?php

declare(strict_types = 1);

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recette>
 */
class RecetteFactory extends Factory
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
			'nom' => fake()->name(),
			'temps_preparation' => $faker->randomNumber(2),
			'temps_cuisson' => $faker->randomNumber(2),
			'temps_repos' => $faker->randomNumber(2),
			'lien' => Str::random(10),
			'url' => Str::random(10),
			'instruction' => Str::random(10),
			'description' => Str::random(10),
			'reference_livre' => Str::random(10),
		];
	}
}

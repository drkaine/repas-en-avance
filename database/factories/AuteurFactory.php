<?php

declare(strict_types = 1);

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auteur>
 */
class AuteurFactory extends Factory
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
			'prenom' => fake()->name(),
			'id_user' => $faker->randomNumber(1),
		];
	}
}

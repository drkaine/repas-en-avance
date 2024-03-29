<?php

declare(strict_types = 1);

namespace Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
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
			'dossier' => Str::random(10),
			'nom' => Str::random(10),
			'description' => Str::random(10),
			'id_recette' => $faker->randomNumber(1),
		];
	}
}

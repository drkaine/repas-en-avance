<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\RelationTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		$tag = new Tag;

		$tag->factory()->create([
			'nom' => 'Régime alimentaire',
		]);

		$tag->factory()->create([
			'nom' => 'Végan',
		]);

		$tag->factory()->create([
			'nom' => 'Ustensiles',
		]);

		$tag->factory()->create([
			'nom' => 'Fouet',
		]);

		$tag->factory()->create([
			'nom' => 'Mode de cuisson',
		]);

		$tag->factory()->create([
			'nom' => 'Four',
		]);

		$relation_tag = new RelationTag;

		$relation_tag->factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);

		$relation_tag->factory()->create([
			'id_tag_parent' => 3,
			'id_tag_enfant' => 4,
		]);

		$relation_tag->factory()->create([
			'id_tag_parent' => 5,
			'id_tag_enfant' => 6,
		]);
	}
}

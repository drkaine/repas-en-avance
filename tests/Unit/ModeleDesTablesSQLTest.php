<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ModeleDesTablesSQLTest extends TestCase
{
	use RefreshDatabase;

	public function testDeLaTableUsers(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		];

		User::factory()->create($user);

		unset($user['password']);

		$this->assertDatabaseHas('users', $user);
	}

	public function testDeLaTableTags(): void
	{
		$tag = [
			'nom' => 'Catégorie',
		];

		Tag::factory()->create($tag);

		$this->assertDatabaseHas('tags', $tag);
	}

	public function testDeLaTableRelationTags(): void
	{
		Tag::factory()->create(['nom' => 'Catégorie', ]);
		Tag::factory()->create(['nom' => 'Plat', ]);

		$relation_tag = [
			'nom_tag_parent' => 'Catégorie',
			'nom_tag_enfant' => 'Plat',
		];

		RelationTag::factory()->create($relation_tag);

		$this->assertDatabaseHas('relation_tags', $relation_tag);
	}
}

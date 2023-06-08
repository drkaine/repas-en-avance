<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AjoutDansLaDBTest extends TestCase
{
	use RefreshDatabase;

	public function testCreationDUnUserApresLInscription(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'password_confirmation' => 'password',
		];

		$this->post('/inscription', $user);

		unset($user['password'], $user['password_confirmation']);

		$this->assertDatabaseHas('users', $user);
	}

	public function testCreationDUnTag(): void
	{
		$tag = [
			'nom' => 'Catégorie',
		];

		$this->post('/ajout_tag', $tag);

		$this->assertDatabaseHas('tags', $tag);
	}

	public function testCreationDUneRelationTag(): void
	{
		Tag::factory()->create(['nom' => 'Catégorie', ]);

		$tag = [
			'nom' => 'Plat',
			'nom_tags_parent' => [
				'Catégorie',
			],
			'nom_tags_enfant' => [
				'Plat',
			],
		];

		$this->post('/ajout_tag', $tag);

		$this->assertDatabaseHas('relation_tags', [
			'nom_tag_parent' => 'Catégorie',
			'nom_tag_enfant' => 'Plat',
		]);
	}
}

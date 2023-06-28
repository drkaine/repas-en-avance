<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class CreationDansLaDBTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	private array $user;

	private array $tag;

	private array $recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
		$this->tag = config('donnee_de_test.tag');
		$this->recette = config('donnee_de_test.recette');
	}

	public function testUserApresLInscription(): void
	{
		$this->user['password_confirmation'] = 'password';

		$this->post('/inscription', $this->user);

		unset($this->user['password'], $this->user['password_confirmation']);

		$this->assertDatabaseHas('users', $this->user);
	}

	public function testUserTagApresLInscription(): void
	{
		$this->user['password_confirmation'] = 'password';

		$this->user['regimes_alimentaires'] = [
			'Catégotie' => 1,
		];

		$this->post('/inscription', $this->user);

		$this->tag();

		$this->assertDatabaseHas('tags_user', [
			'id_user' => 1,
			'id_tag' => 1,
		]);
	}

	public function testTag(): void
	{
		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('tags', $this->tag);
	}

	public function testRelationTagParent(): void
	{
		$this->tag();

		$this->tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [
				1,
			],
			'id_tags_enfant' => [],
		];

		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('relation_tags', [
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);
	}

	public function testRelationTagEnfant(): void
	{
		$this->tag();

		$this->tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [],
			'id_tags_enfant' => [
				1,
			],
		];

		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('relation_tags', [
			'id_tag_parent' => 2,
			'id_tag_enfant' => 1,
		]);
	}

	public function testRecette(): void
	{
		$this->post('/ajout_recette', $this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}
}

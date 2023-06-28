<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class CreationDansLaDBTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	private array $donnees_tag;

	private array $donnees_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
		$this->donnees_tag = $this->donneesTag();
		$this->donnees_recette = $this->donneesRecette();
	}

	public function testUserApresLInscription(): void
	{
		$this->donnees_user['password_confirmation'] = 'password';

		$this->post('/inscription', $this->donnees_user);

		unset($this->donnees_user['password'], $this->donnees_user['password_confirmation']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testUserTagApresLInscription(): void
	{
		$this->donnees_user['password_confirmation'] = 'password';

		$this->donnees_user['regimes_alimentaires'] = [
			'Catégotie' => 1,
		];

		$this->post('/inscription', $this->donnees_user);

		$this->tag();

		$this->assertDatabaseHas('tags_user', [
			'id_user' => 1,
			'id_tag' => 1,
		]);
	}

	public function testTag(): void
	{
		$this->post('/ajout_tag', $this->donnees_tag);

		$this->assertDatabaseHas('tags', $this->donnees_tag);
	}

	public function testRelationTagParent(): void
	{
		$this->tag();

		$this->donnees_tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [
				1,
			],
			'id_tags_enfant' => [],
		];

		$this->post('/ajout_tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', [
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);
	}

	public function testRelationTagEnfant(): void
	{
		$this->tag();

		$this->donnees_tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [],
			'id_tags_enfant' => [
				1,
			],
		];

		$this->post('/ajout_tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', [
			'id_tag_parent' => 2,
			'id_tag_enfant' => 1,
		]);
	}

	public function testRecette(): void
	{
		$this->post('/ajout_recette', $this->donnees_recette);

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}
}

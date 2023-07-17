<?php

declare(strict_types = 1);

namespace Tests\Feature\Envoie;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class FormulaireTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_recette = $this->donnees('recette');

		$this->donnees_recette['ingredients'] = [
			'Carotte' => 2,
		];

		$this->donnees_recette['quantites'] = [
			'Carotte' => 1,
		];
	}

	public function testInscription(): void
	{
		$this->donnees_user['password_confirmation'] = 'password';

		$this->donnees_user['regimes_alimentaires'] = [];

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(201);
	}

	public function testConnexion(): void
	{
		$this->creationUser();

		unset($this->donnees_user['nom']);

		$response = $this->post('/connexion', $this->donnees_user);

		$response->assertStatus(201);
	}

	public function testAjoutTag(): void
	{
		$response = $this->post('/ajout-tag', [
			'nom' => 'Catégorie',
			'tags_parent' => [],
			'tags_enfant' => [],
		]);

		$response->assertStatus(201);
	}

	public function testAjoutRecette(): void
	{
		$response = $this->post('/ajout-recette', $this->donnees_recette);

		$response->assertStatus(201);
	}
}

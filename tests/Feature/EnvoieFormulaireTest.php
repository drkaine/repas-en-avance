<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class EnvoieFormulaireTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
		$this->donnees_recette = $this->donneesRecette();
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
		$this->user();

		unset($this->donnees_user['nom']);

		$response = $this->post('/connexion', $this->donnees_user);

		$response->assertStatus(201);
	}

	public function testAjoutTag(): void
	{
		$response = $this->post('/ajout_tag', [
			'nom' => 'Catégorie',
			'id_tags_parent' => [],
			'id_tags_enfant' => [],
		]);

		$response->assertStatus(201);
	}

	public function testAjoutRecette(): void
	{
		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(201);
	}
}

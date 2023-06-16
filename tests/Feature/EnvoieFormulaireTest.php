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

	private array $user;

	private array $recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
		$this->recette = config('donnee_de_test.recette');
	}

	public function testInscription(): void
	{
		$this->user['password_confirmation'] = 'password';

		$response = $this->post('/inscription', $this->user);

		$response->assertStatus(201);
	}

	public function testConnexion(): void
	{
		$this->user();

		unset($this->user['nom']);

		$response = $this->post('/connexion', $this->user);

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
		$response = $this->post('/ajout_recette', $this->recette);

		$response->assertStatus(201);
	}
}

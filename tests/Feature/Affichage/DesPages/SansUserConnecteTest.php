<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage\DesPages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class SansUserConnecteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	public function testAccueil(): void
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testInscription(): void
	{
		$this->creationRegimesAlimentaire();

		$response = $this->get('inscription');

		$response->assertStatus(200);
	}

	public function testConnexion(): void
	{
		$response = $this->get('connexion');

		$response->assertStatus(200);
	}

	public function testRecuperationCompte(): void
	{
		$response = $this->get('recuperation-compte');

		$response->assertStatus(200);
	}

	public function testCatalogueRecettes(): void
	{
		$this->creationRecette();

		$this->creationTagIngredient();

		$this->creationIngredient();

		$response = $this->get('catalogue-recettes');

		$response->assertStatus(200);
	}

	public function testConfirmationEmail(): void
	{
		$user = $this->creationUser();

		$response = $this->get('confirmation-email/' . $user->email);

		$response->assertStatus(200);
	}
}

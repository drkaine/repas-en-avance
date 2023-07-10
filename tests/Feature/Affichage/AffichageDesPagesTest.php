<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class AffichageDesPagesTest extends TestCase
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

	public function testAjoutTag(): void
	{
		$this->userConnecte();

		$this->creationTag();

		$response = $this->get('ajout-tag');

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$this->userConnecte();

		$this->creationTagsAjoutRecette();

		$response = $this->get('ajout-recette');

		$response->assertStatus(200);
	}

	public function testMonCompte(): void
	{
		$this->userConnecte();

		$this->creationRegimesAlimentaire();

		$response = $this->get('mon-compte');

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

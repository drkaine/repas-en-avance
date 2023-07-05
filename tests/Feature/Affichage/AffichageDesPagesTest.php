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

		$response = $this->get('ajout_tag');

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$this->userConnecte();

		$response = $this->get('ajout_recette');

		$response->assertStatus(200);
	}

	public function testMonCompte(): void
	{
		$this->userConnecte();

		$this->creationRegimesAlimentaire();

		$response = $this->get('mon_compte');

		$response->assertStatus(200);
	}

	public function testRecuperatoinCompte(): void
	{
		$response = $this->get('recuperation_compte');

		$response->assertStatus(200);
	}

	public function testRecettes(): void
	{
		$response = $this->get('recettes');

		$response->assertStatus(200);
	}

	public function testConfirmationEmail(): void
	{
		$user = $this->creationUser();

		$response = $this->get('confirmation_email/' . $user->id);

		$response->assertStatus(200);
	}
}

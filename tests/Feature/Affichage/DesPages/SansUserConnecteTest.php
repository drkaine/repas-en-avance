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
		$this->creation('Recette', 'recette');

		$this->creationDonnees('Tag', 'tag_ingredient');

		$this->creation('Ingredient', 'ingredient');

		$response = $this->get('catalogue-recettes');

		$response->assertStatus(200);
	}

	public function testConfirmationEmail(): void
	{
		$user = $this->creationUser();

		$response = $this->get('confirmation-email/' . $user->email);

		$response->assertStatus(200);
	}

	public function testMotDePasseOubliePourChangerLeMotDePasse(): void
	{
		$response = $this->get('mot-de-passe-oublie/oigoiuyv');

		$response->assertStatus(200);
	}

	public function testDemandeMotDePasseOublie(): void
	{
		$response = $this->get('demande-mot-de-passe-oublie');

		$response->assertStatus(200);
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class AffichageDesPagesTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	public function testAccueil(): void
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testInscription(): void
	{
		$this->RegimesAlimentaire();

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

		$tag = new Tag;

		$tag->factory()->create(['nom' => 'Catégorie', ]);

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

		$this->regimesAlimentaire();

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
}

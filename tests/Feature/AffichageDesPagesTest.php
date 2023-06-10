<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AffichageDesPagesTest extends TestCase
{
	use RefreshDatabase;

	public function testAccueil(): void
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testInscription(): void
	{
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
		Tag::factory()->create(['nom' => 'Catégorie', ]);

		$response = $this->get('ajout_tag');

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$response = $this->get('ajout_recette');

		$response->assertStatus(200);
	}

	public function testDeconnexion(): void
	{
		$response = $this->get('deconnexion');

		$response->assertRedirect('/');
	}
}

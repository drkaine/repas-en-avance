<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class EnvoieFormulaireTest extends TestCase
{
	use RefreshDatabase;

	public function testInscription(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(201);
	}

	public function testConnexion(): void
	{
		User::factory()->create([
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		]);

		$response = $this->post('/connexion', [
			'email' => 'email@test.fr',
			'password' => 'password',
		]);

		$response->assertStatus(201);
	}

	public function testAjoutTag(): void
	{
		$response = $this->post('/ajout_tag', [
			'nom' => 'Catégorie',
			'nom_tags_parent' => [],
			'nom_tags_enfant' => [],
		]);

		$response->assertStatus(201);
	}

	public function testAjoutRecette(): void
	{
		$response = $this->post('/ajout_recette', [
			'temps_preparation' => 1,
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => null,
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
			'nom' => 'Carotte simple',
		]);

		$response->assertStatus(201);
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AjoutRecetteTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsNom(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => null,
			'temps_preparation' => 1,
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv',
			'temps_preparation' => 1,
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsNom(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => 'az',
			'temps_preparation' => 1,
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}

	public function testChampsTempsDePreparation(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => 'Carotte simple',
			'temps_preparation' => null,
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsLien(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => 'Carotte simple',
			'temps_preparation' => 1,
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}
}

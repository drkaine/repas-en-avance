<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ValidationChampsFormulaireDAjoutRecetteTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsNom(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => '',
			'temps_preparation' => '1',
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurChampsNom(): void
	{
		$response = $this->post('/ajout_recette', [
			'nom' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv',
			'temps_preparation' => '1',
			'temps_cuisson' => 2,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
		]);

		$response->assertStatus(302);
	}
}

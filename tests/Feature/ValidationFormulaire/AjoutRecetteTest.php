<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class AjoutRecetteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_recette = $this->donneesRecette();

		$this->donnees_recette['ingredients'] = [
			'Carotte' => 2,
		];

		$this->donnees_recette['quantites'] = [
			'Carotte' => 1,
		];
	}

	public function testChampsNom(): void
	{
		$this->donnees_recette['nom'] = null;

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$this->donnees_recette['nom'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsNom(): void
	{
		$this->donnees_recette['nom'] = 'az';

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testChampsTempsDePreparation(): void
	{
		$this->donnees_recette['temps_preparation'] = null;

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsLien(): void
	{
		$this->donnees_recette['lien'] = 'https://.fr';

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsInstruction(): void
	{
		$this->donnees_recette['instruction'] = 'Eplu';

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsDescription(): void
	{
		$this->donnees_recette['description'] = 'Rece';

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsReference(): void
	{
		$this->donnees_recette['reference_livre'] = 'Tous';

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testChampsIngredient(): void
	{
		unset($this->donnees_recette['ingredients']);

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}

	public function testChampsQuantite(): void
	{
		unset($this->donnees_recette['quantites']);

		$response = $this->post('/ajout_recette', $this->donnees_recette);

		$response->assertStatus(302);
	}
}

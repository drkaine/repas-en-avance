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

	private array $donnees_formulaire_ajout_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();
	}

	public function testChampsNom(): void
	{
		$this->donnees_formulaire_ajout_recette['nom'] = null;

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$this->donnees_formulaire_ajout_recette['nom'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsNom(): void
	{
		$this->donnees_formulaire_ajout_recette['nom'] = 'az';

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testChampsDescription(): void
	{
		$this->donnees_formulaire_ajout_recette['description'] = null;

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsDescription(): void
	{
		$this->donnees_formulaire_ajout_recette['description'] = 'az';

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testChampsTempsDePreparation(): void
	{
		$this->donnees_formulaire_ajout_recette['temps_preparation'] = null;

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testChampsIngredient(): void
	{
		unset($this->donnees_formulaire_ajout_recette['ingredients']);

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testChampsQuantite(): void
	{
		unset($this->donnees_formulaire_ajout_recette['quantitees']);

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}

	public function testChampsPhoto(): void
	{
		unset($this->donnees_formulaire_ajout_recette['photos']);

		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(302);
	}
}

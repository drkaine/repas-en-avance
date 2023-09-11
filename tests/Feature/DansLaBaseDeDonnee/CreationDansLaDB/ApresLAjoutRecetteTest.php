<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\Creation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class ApresLAjoutRecetteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_recette;

	private array $donnees_ustensile;

	private array $donnees_mode_de_cuisson;

	private array $donnees_ingredient;

	private array $donnees_photo;

	protected function setUp(): void
	{
		parent::setUp();
		$this->donnees_recette = $this->donnees('recette');
		$this->donnees_ustensile = $this->donnees('ustensile');
		$this->donnees_mode_de_cuisson = $this->donnees('mode_de_cuisson');
		$this->donnees_ingredient = $this->donnees('ingredient');
		$this->donnees_photo = $this->donnees('photo');

		$this->donnees_recette['ingredients'] = [
			'Carotte' => '2',
		];

		$this->donnees_recette['quantitees'] = [
			'2' => '1',
		];

		$this->donnees_recette['photos'] = [
			$this->donnees_photo,
		];

	}

	public function testRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_recette);

		unset(
			$this->donnees_recette['ingredients'],
			$this->donnees_recette['quantitees'],
			$this->donnees_recette['photos']
		);

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testUstensileDansAjoutRecette(): void
	{
		$this->donnees_recette['ustensiles'] = [
			'Cuillière' => 2,
		];

		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('ustensiles', $this->donnees_ustensile);
	}

	public function testModeDeCuissonDansAjoutRecette(): void
	{
		$this->donnees_recette['mode_de_cuissons'] = [
			'Four' => 2,
		];

		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('mode_de_cuissons', $this->donnees_mode_de_cuisson);
	}

	public function testIngredientDansAjoutRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('ingredients', $this->donnees_ingredient);
	}

	public function testPhotoDansAjoutRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('photos', $this->donnees_photo);
	}
}

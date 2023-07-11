<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

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

	protected function setUp(): void
	{
		parent::setUp();

		$this->creationTagsAjoutRecette();
		$this->userConnecte();
	}

	public function testUstensileDansAjoutRecette(): void
	{
		$response = $this->get('ajout-recette');

		$ustensiles = $response->viewData('ustensiles');

		foreach ($ustensiles as $ustensile) {
			$response->assertSee($ustensile->nom);
		}
	}

	public function testModeDeCuissonDansAjoutRecette(): void
	{
		$response = $this->get('ajout-recette');

		$mode_de_cuissons = $response->viewData('mode_de_cuissons');

		foreach ($mode_de_cuissons as $mode_de_cuisson) {
			$response->assertSee($mode_de_cuisson->nom);
		}
	}

	public function testIngredientDansAjoutRecette(): void
	{

		$response = $this->get('ajout-recette');

		$ingredients = $response->viewData('ingredients');

		foreach ($ingredients as $ingredient) {
			$response->assertSee($ingredient->nom);
		}
	}
}

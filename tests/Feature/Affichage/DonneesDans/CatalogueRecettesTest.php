<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class CatalogueRecettesTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	public function testRecetteDansCatalogueRecettes(): void
	{
		$this->creationRecette();

		$this->creationTagIngredient();

		$this->creationIngredient();

		$response = $this->get('catalogue-recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			$response->assertSee($recette->temps_preparation);

			$response->assertSee($recette->nom);

			$response->assertSee($recette->temps_cuisson);

			$response->assertSee($recette->temps_repos);
		}
	}

	public function testIngredientDansCatalogueRecettes(): void
	{
		$this->creationRecette();

		$this->creationTagIngredient();

		$this->creationIngredient();

		$response = $this->get('catalogue-recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			foreach ($recette->recuperationIngredient as $ingredient) {
				$response->assertSee($ingredient->id);

				$response->assertSee($ingredient->nom);
			}
		}
	}
}

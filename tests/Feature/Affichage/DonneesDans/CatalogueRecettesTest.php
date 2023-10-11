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

	protected function setUp(): void
	{
		parent::setUp();

		$this->creationTagsAjoutRecette();
		$this->creation('Recette', 'recette');
		$this->creation('Ingredient', 'ingredient');
		$this->creation('Photo', 'photo');
	}

	public function testRecetteDansCatalogueRecettes(): void
	{
		$response = $this->get('catalogue-recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			$response->assertSee($recette->temps_preparation);

			$response->assertSee($recette->nom);

			$response->assertSee($recette->temps_cuisson);
		}
	}

	public function testIngredientDansCatalogueRecettes(): void
	{

		$response = $this->get('catalogue-recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			foreach ($recette->recuperationIngredient as $ingredient) {
				$response->assertSee($ingredient->id);

				$response->assertSee($ingredient->nom);
			}
		}
	}

	public function testPhotoRecette(): void
	{
		$response = $this->get('catalogue-recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			foreach ($recette->recuperationPhoto as $photo) {
				$response->assertSee($photo->nom);
				$response->assertSee($photo->description);
				$response->assertSee($photo->dossier);
			}
		}
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage\DonneesDans;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class CarnetRecettesTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	protected function setUp(): void
	{
		parent::setUp();

		$this->creationTagsAjoutRecette();
		$this->creation('Recette', 'recette');
		$this->creation('CarnetRecette', 'carnet_recette');
		$this->creation('Ingredient', 'ingredient');
		$this->creation('Photo', 'photo');
		$this->creationFichierPhoto();

		$this->userConnecte();
	}

	public function testRecetteDansCatalogueRecettes(): void
	{
		$response = $this->get('carnet-recettes');
		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			$response->assertSee($recette->temps_preparation);

			$response->assertSee($recette->nom);

			$response->assertSee($recette->url);

			$response->assertSee($recette->temps_cuisson);
		}
	}

	public function testIngredientDansCatalogueRecettes(): void
	{

		$response = $this->get('carnet-recettes');

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
		$response = $this->get('carnet-recettes');

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

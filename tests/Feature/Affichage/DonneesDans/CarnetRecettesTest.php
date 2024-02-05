<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationTagsAjoutRecette();
	$this->creation('Recette', 'recette');
	$this->creation('CarnetRecette', 'carnet_recette');
	$this->creation('Ingredient', 'ingredient');
	$this->creation('Photo', 'photo');
	$this->creationFichierPhoto();

	$this->userConnecte();
});
test('recette dans catalogue recettes', function (): void {
	$response = $this->get('carnet-recettes');
	$recettes = $response->viewData('recettes');

	foreach ($recettes as $recette) {
		$response->assertSee($recette->temps_preparation);

		$response->assertSee($recette->nom);

		$response->assertSee($recette->url);

		$response->assertSee($recette->temps_cuisson);
	}
});
test('ingredient dans catalogue recettes', function (): void {
	$response = $this->get('carnet-recettes');

	$recettes = $response->viewData('recettes');

	foreach ($recettes as $recette) {
		foreach ($recette->recuperationIngredient as $ingredient) {
			$response->assertSee($ingredient->id);

			$response->assertSee($ingredient->nom);
		}
	}
});
test('photo recette', function (): void {
	$response = $this->get('carnet-recettes');

	$recettes = $response->viewData('recettes');

	foreach ($recettes as $recette) {
		foreach ($recette->recuperationPhoto as $photo) {
			$response->assertSee($photo->nom);
			$response->assertSee($photo->description);
			$response->assertSee($photo->dossier);
		}
	}
});

<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationTagsAjoutRecette();
	$this->creation('Recette', 'recette');
	$this->creation('Ingredient', 'ingredient');
	$this->creation('Photo', 'photo');
});
test('recettes', function (): void {
	$response = $this->get('/');

	$recettes = $response->viewData('recettes');

	foreach ($recettes as $recette) {
		$response->assertSee($recette->temps_preparation);

		$response->assertSee($recette->nom);

		$response->assertSee($recette->url);

		$response->assertSee($recette->temps_cuisson);
	}
});
test('ingredient des dernieres recettes', function (): void {
	$response = $this->get('/');

	$recettes = $response->viewData('recettes');

	foreach ($recettes as $recette) {
		foreach ($recette->recuperationIngredient as $ingredient) {
			$response->assertSee($ingredient->nom);
		}
	}
});
test('photo recette', function (): void {
	$response = $this->get('catalogue-recettes');

	$recettes = $response->viewData('recettes');

	foreach ($recettes as $recette) {
		foreach ($recette->recuperationPhoto as $photo) {
			$response->assertSee($photo->nom);
			$response->assertSee($photo->description);
			$response->assertSee($photo->dossier);
		}
	}
});

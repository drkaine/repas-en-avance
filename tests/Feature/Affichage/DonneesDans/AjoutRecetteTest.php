<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationTagsAjoutRecette();
	$this->userConnecte();
});
test('ustensile dans ajout recette', function (): void {
	$response = $this->get('ajout-recette');

	$ustensiles = $response->viewData('ustensiles');

	foreach ($ustensiles as $ustensile) {
		$response->assertSee($ustensile->nom);
	}
});
test('mode de cuisson dans ajout recette', function (): void {
	$response = $this->get('ajout-recette');

	$mode_de_cuissons = $response->viewData('mode_de_cuissons');

	foreach ($mode_de_cuissons as $mode_de_cuisson) {
		$response->assertSee($mode_de_cuisson->nom);
	}
});
test('ingredient dans ajout recette', function (): void {
	$response = $this->get('ajout-recette');

	$ingredients = $response->viewData('ingredients');

	foreach ($ingredients as $ingredient) {
		$response->assertSee($ingredient->nom);
	}
});

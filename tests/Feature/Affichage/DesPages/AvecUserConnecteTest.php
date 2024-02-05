<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->userConnecte();
});
test('ajout tag', function (): void {
	$this->creation('Tag', 'tag');

	$response = $this->get('ajout-tag');

	$response->assertStatus(200);
});
test('ajout recette', function (): void {
	$this->creationTagsAjoutRecette();

	$response = $this->get('ajout-recette');

	$response->assertStatus(200);
});
test('mon compte', function (): void {
	$this->creationRegimesAlimentaire();

	$response = $this->get('mon-compte');

	$response->assertStatus(200);
});
test('carnet de recettes', function (): void {
	$this->creation('Recette', 'recette');

	$this->creationDonnees('Tag', 'tag_ingredient');

	$this->creation('Ingredient', 'ingredient');

	$this->creation('CarnetRecette', 'carnet_recette');

	$response = $this->get('carnet-recettes');

	$response->assertStatus(200);
});

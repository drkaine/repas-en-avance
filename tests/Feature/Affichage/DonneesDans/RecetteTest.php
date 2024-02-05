<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationTagsAjoutRecette();
	$this->creation('Recette', 'recette');
	$this->creation('Photo', 'photo');
	$this->creationFichierPhoto();
});
test('element recette carotte simple', function (): void {
	$response = $this->get('recette/carotte-simple');

	$recette = $response->viewData('recette');

	$response->assertSee($recette->temps_preparation);
	$response->assertSee($recette->temps_cuisson);
	$response->assertSee($recette->temps_repos);
	$response->assertSee($recette->lien);
	$response->assertSee($recette->instruction);
	$response->assertSee($recette->description);
	$response->assertSee($recette->reference_livre);
	$response->assertSee($recette->nom);
});
test('photo recette carotte simple', function (): void {
	$response = $this->get('recette/carotte-simple');

	$recette = $response->viewData('recette');

	foreach ($recette->recuperationPhoto as $photo) {
		$response->assertSee($photo->nom);
		$response->assertSee($photo->description);
		$response->assertSee($photo->dossier);
	}
});

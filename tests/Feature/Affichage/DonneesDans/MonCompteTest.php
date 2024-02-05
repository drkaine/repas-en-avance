<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationRegimesAlimentaire();

	$this->userConnecte();
});
test('user dans mon compte', function (): void {
	$response = $this->get('mon-compte');

	$donnee_user = $response->viewData('user');

	$response->assertSee($donnee_user->nom);

	$response->assertSee($donnee_user->email);
});
test('tag dans mon compte', function (): void {
	$response = $this->get('mon-compte');

	$tags_regimes_alimentaires = $response->viewData('tags_regimes_alimentaires');

	foreach ($tags_regimes_alimentaires as $tag_regime_alimentaire) {
		$response->assertSee($tag_regime_alimentaire->nom);

		$response->assertSee($tag_regime_alimentaire->id);
	}
});
test('regime alimentaire dans mon compte', function (): void {
	$this->creation('RegimeAlimentaire', 'regime_alimentaire');

	$response = $this->get('mon-compte');

	$regimes_alimentaires = $response->viewData('regimes_alimentaires');

	foreach ($regimes_alimentaires as $regime_alimentaire) {
		$response->assertSee($regime_alimentaire);
	}
});

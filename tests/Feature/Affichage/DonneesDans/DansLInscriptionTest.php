<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationRegimesAlimentaire();
});
test('tag dans l inscription', function (): void {
	$this->creationRegimesAlimentaire();

	$response = $this->get('inscription');

	$regimes_alimentaires = $response->viewData('regimes_alimentaires');

	foreach ($regimes_alimentaires as $regime_alimentaire) {
		$response->assertSee($regime_alimentaire->nom);

		$response->assertSee($regime_alimentaire->id);
	}
});

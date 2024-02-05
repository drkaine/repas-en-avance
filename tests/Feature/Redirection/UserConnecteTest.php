<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

test('inscription', function (): void {
	$this->userConnecte();

	$response = $this->get('inscription');

	$response->assertRedirect('mon-compte');
});
test('connexion', function (): void {
	$this->userConnecte();

	$response = $this->get('connexion');

	$response->assertRedirect('mon-compte');
});

<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationTagsAjoutRecette();
	$this->creation('Recette', 'recette');
});
test('recette', function (): void {
	$response = $this->get('recette/carotte-simple');

	$response->assertStatus(200);
});

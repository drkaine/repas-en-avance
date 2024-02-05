<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('champs nom', function (): void {
	$response = $this->post('/ajout-tag', [
		'nom' => null,
	]);

	$response->assertStatus(302);
});
test('longueur maximum champs nom', function (): void {
	$response = $this->post('/ajout-tag', [
		'nom' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv',
	]);

	$response->assertStatus(302);
});
test('longueur minimum champs nom', function (): void {
	$response = $this->post('/ajout-tag', [
		'nom' => 'az',
	]);

	$response->assertStatus(302);
});

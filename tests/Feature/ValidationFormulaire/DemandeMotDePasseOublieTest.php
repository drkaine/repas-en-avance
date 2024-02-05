<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('champs email', function (): void {
	$response = $this->post('/demande-mot-de-passe-oublie', [
		'email' => null,
	]);

	$response->assertStatus(302);
});
test('longueur maximum champs email', function (): void {
	$response = $this->post('/demande-mot-de-passe-oublie', [
		'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
	]);

	$response->assertStatus(302);
});
test('longueur minimum champs email', function (): void {
	$response = $this->post('/demande-mot-de-passe-oublie', [
		'email' => 'a@afr',
	]);

	$response->assertStatus(302);
});
test('format champs email', function (): void {
	$response = $this->post('/demande-mot-de-passe-oublie', [
		'email' => 'emailestfr',
	]);

	$response->assertStatus(302);
});

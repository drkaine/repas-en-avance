<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('champs email', function (): void {
	$response = $this->post('/connexion', [
		'email' => null,
		'password' => 'password',
	]);

	$response->assertStatus(302);
});
test('longueur maximum champs email', function (): void {
	$response = $this->post('/connexion', [
		'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
		'password' => 'password',
	]);

	$response->assertStatus(302);
});
test('longueur minimum champs email', function (): void {
	$response = $this->post('/connexion', [
		'email' => 'a@afr',
		'password' => 'password',
	]);

	$response->assertStatus(302);
});
test('format champs email', function (): void {
	$response = $this->post('/connexion', [
		'email' => 'emailestfr',
		'password' => 'password',
	]);

	$response->assertStatus(302);
});
test('champs password', function (): void {
	$response = $this->post('/connexion', [
		'email' => 'email.test.fr',
		'password' => null,
	]);

	$response->assertStatus(302);
});
test('longueur minimum champs password', function (): void {
	$response = $this->post('/connexion', [
		'email' => 'email.test.fr',
		'password' => 'fg',
	]);

	$response->assertStatus(302);
});
test('longueur maximum champs password', function (): void {
	$response = $this->post('/connexion', [
		'email' => 'email.test.fr',
		'password' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio',
	]);

	$response->assertStatus(302);
});

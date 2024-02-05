<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('champs email', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		'email' => null,
		'password' => 'password',
		'password_confirmation' => 'password',
	]);

	$response->assertStatus(302);
});
test('longueur maximum champs email', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
		'password' => 'password',
		'password_confirmation' => 'password',
	]);

	$response->assertStatus(302);
});
test('longueur minimum champs email', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		'email' => 'a@afr',
		'password' => 'password',
		'password_confirmation' => 'password',
	]);

	$response->assertStatus(302);
});
test('format champs email', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		'email' => 'emailestfr',
		'password' => 'password',
		'password_confirmation' => 'password',
	]);

	$response->assertStatus(302);
});
test('champs mot de passe', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		[
			'email' => 'anonyme@anonnyme.fr',
			'password' => null,
			'password_confirmation' => 'password',
		],
	]);

	$response->assertStatus(302);
});
test('longueur minimum champs password', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		'email' => 'email.test.fr',
		'password' => 'fg',
		'password_confirmation' => 'password',
	]);

	$response->assertStatus(302);
});
test('longueur maximum champs password', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		'email' => 'email.test.fr',
		'password' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio',
		'password_confirmation' => 'password',
	]);

	$response->assertStatus(302);
});
test('champs mot de passe confirme', function (): void {
	$response = $this->post('/mot-de-passe-oublie', [
		[
			'email' => 'anonyme@anonnyme.fr',
			'password' => 'password',
			'password_confirmation' => null,
		],
	]);

	$response->assertStatus(302);
});

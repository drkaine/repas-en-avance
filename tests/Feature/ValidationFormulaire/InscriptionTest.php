<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');

	$this->donnees_user['email_verified_at'] = '2023-06-06 06:06:06';

	$this->donnees_user['password_confirmation'] = 'password';
});
test('champs nom', function (): void {
	$this->donnees_user['nom'] = null;

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur maximum champs nom', function (): void {
	$this->donnees_user['nom'] = 'aztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur minimum champs nom', function (): void {
	$this->donnees_user['nom'] = 'az';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('champs prenom', function (): void {
	$this->donnees_user['prenom'] = null;

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur maximum champs prenom', function (): void {
	$this->donnees_user['prenom'] = 'aztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur minimum champs prenom', function (): void {
	$this->donnees_user['prenom'] = 'az';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('champs email', function (): void {
	$this->donnees_user['email'] = null;

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur maximum champs email', function (): void {
	$this->donnees_user['email'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur minimum champs email', function (): void {
	$this->donnees_user['email'] = 'a@.fr';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('format champs email', function (): void {
	$this->donnees_user['email'] = 'emailestfr';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('champs password', function (): void {
	$this->donnees_user['password'] = null;

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur minimum password', function (): void {
	$this->donnees_user['password'] = 'p';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('longueur maximum password', function (): void {
	$this->donnees_user['password'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});
test('champs password confirmation', function (): void {
	unset($this->donnees_user['password_confirmation']);

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(302);
});

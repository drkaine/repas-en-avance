<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');
});
test('champs nom', function (): void {
	$this->donnees_user_anonyme_recupere['nom'] = null;

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('longueur maximum champs nom', function (): void {
	$this->donnees_user_anonyme_recupere['nom'] = 'aztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('longueur minimum champs nom', function (): void {
	$this->donnees_user_anonyme_recupere['nom'] = 'az';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('champs email', function (): void {
	$this->donnees_user_anonyme_recupere['email'] = null;

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('longueur maximum champs email', function (): void {
	$this->donnees_user_anonyme_recupere['email'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('longueur minimum champs email', function (): void {
	$this->donnees_user_anonyme_recupere['email'] = 'a@.fr';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('format champs email', function (): void {
	$this->donnees_user_anonyme_recupere['email'] = 'emailestfr';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('champs password', function (): void {
	$this->donnees_user_anonyme_recupere['password'] = null;

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('longueur minimum password', function (): void {
	$this->donnees_user_anonyme_recupere['password'] = 'p';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});
test('longueur maximum password', function (): void {
	$this->donnees_user_anonyme_recupere['password'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertStatus(302);
});

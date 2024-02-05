<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');
	$this->donnees_user['password_confirmation'] = 'password';
});
test('user apres l inscription', function (): void {
	$this->donnees_user['regimes_alimentaires'] = [];

	$this->post('/inscription', $this->donnees_user);

	unset($this->donnees_user['password'], $this->donnees_user['password_confirmation'], $this->donnees_user['regimes_alimentaires'], $this->donnees_user['email_verified_at']);

	$this->assertDatabaseHas('users', $this->donnees_user);
});
test('user tag apres l inscription', function (): void {
	$this->donnees_user['regimes_alimentaires'] = [
		'2',
	];

	$this->post('/inscription', $this->donnees_user);

	$this->creation('Tag', 'tag');

	$this->assertDatabaseHas('regimes_alimentaires', $this->donnees('regime_alimentaire'));
});

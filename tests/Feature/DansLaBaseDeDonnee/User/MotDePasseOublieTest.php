<?php

declare(strict_types = 1);
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');

	$this->mot_de_passe_oublie = $this->donnees('mot_de_passe_oublie');

	$user = $this->creationUser();
});
test('changement mot de passe', function (): void {
	$this->post('/mot-de-passe-oublie', $this->mot_de_passe_oublie);

	$this->assertDatabaseMissing('users', $this->donnees_user);

	$this->donnees_user['password'] = $this->mot_de_passe_oublie['password'];

	$user = new User;

	$user = $user->first();

	expect(password_verify($this->mot_de_passe_oublie['password'], $user->password))->toBeTrue();
});

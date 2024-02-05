<?php

declare(strict_types = 1);
use Illuminate\Support\Facades\Auth;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');
});
test('connexion', function (): void {
	$user = $this->creationUser();

	unset($this->donnees_user['nom'], $this->donnees_user['email_verified_at']);

	$this->post('/connexion', $this->donnees_user);

	expect(Auth::user()->id)->toBe($user->id);
});
test('deconnexion', function (): void {
	$this->userConnecte();

	$this->get('deconnexion');

	$this->assertGuest();
});

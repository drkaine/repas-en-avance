<?php

declare(strict_types = 1);
uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function (): void {
	$this->donnees_user_anonyme = $this->donnees('user');

	$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');

	$this->creation('User', 'user_anonyme');
});
test('recuperation compte user', function (): void {
	$this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	unset($this->donnees_user_anonyme_recupere['email_anonyme'], $this->donnees_user_anonyme_recupere['password']);

	$this->assertDatabaseMissing('users', $this->donnees_user_anonyme);

	$this->assertDatabaseHas('users', $this->donnees_user_anonyme_recupere);
});

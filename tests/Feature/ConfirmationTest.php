<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

test('inscription user', function (): void {
	$user = $this->creationUser();

	$donnees_user = $this->donnees('user');

	$donnees_user['email_verified_at'] = null;

	$this->get('confirmation-email/' . $user->email);

	$this->assertDatabaseMissing('users', $donnees_user);

	$this->assertNotSame($user->email_verified_at, null);
});

<?php

declare(strict_types = 1);
use App\Services\GestionUsersInactifService;
use Carbon\Carbon;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');
	$this->donnees_user_anonyme = $this->donnees('user_anonyme');
	unset($this->donnees_user_anonyme['password'], $this->donnees_user_anonyme['derniere_connexion']);
});
test('anonymisation user', function (): void {
	$user = $this->creationUser();

	unset($this->donnees_user['password']);

	$this->actingAs($user);

	$this->get('/anonymisation-du-compte');

	$this->assertDatabaseMissing('users', $this->donnees_user);

	$this->assertDatabaseHas('users', $this->donnees_user_anonyme);
});
test('anonymisation users inactif', function (): void {
	$date = new Carbon;

	$user = $this->creationUser();

	$user->derniere_connexion = $date->now()->subMonths(4);

	$user->save();

	$anonymisation_helper = new GestionUsersInactifService;

	$anonymisation_helper->anonymiser();

	$this->assertDatabaseMissing('users', $this->donnees_user);

	$this->assertDatabaseHas('users', $this->donnees_user_anonyme);
});

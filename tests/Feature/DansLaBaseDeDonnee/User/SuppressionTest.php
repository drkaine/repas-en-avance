<?php

declare(strict_types = 1);
use App\Services\GestionUsersInactifService;
use Carbon\Carbon;

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function (): void {
	$this->donnees_user_anonyme = $this->donnees('user');

	$this->anonymisation_helper = new GestionUsersInactifService;

	$this->creation('User', 'user_anonyme');
});
test('users anonymes', function (): void {
	$this->anonymisation_helper->supprimer();

	$this->assertDatabaseMissing('users', $this->donnees_user_anonyme);
});
test('regime alimentaire des users anonymes', function (): void {
	$date = new Carbon;

	$donnees_user_anonyme['derniere_connexion'] = $date->now()->subMonths(7);

	$this->creation('RegimeAlimentaire', 'regime_alimentaire');

	$this->anonymisation_helper->supprimer();

	$this->assertDatabaseMissing('regimes_alimentaires', $this->donnees('regime_alimentaire'));
});

<?php

declare(strict_types = 1);
use Carbon\Carbon;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');

	$this->donnees_user_modifie = $this->donnees('user_modifie');

	$this->tags_regimes_alimentaire = config('donnee_de_test.tags_regimes_alimentaire');
});
test('du user', function (): void {
	$user = $this->creationUser();

	unset($this->donnees_user['password']);

	$this->actingAs($user);

	$this->post('/modification-user', $this->donnees_user_modifie);

	$this->assertDatabaseMissing('users', $this->donnees_user);

	$this->assertDatabaseHas('users', $this->donnees_user_modifie);
});
test('du regime alimentaire', function (): void {
	$user = $this->creationUser();

	$this->creationRegimesAlimentaire();

	$this->creation('RegimeAlimentaire', 'regime_alimentaire');

	unset($this->donnees_user['password']);

	$this->actingAs($user);

	$this->donnees_user_modifie['tags_regimes_alimentaires'] = [
		'3',
	];

	$this->post('/modification-user', $this->donnees_user_modifie);

	$this->assertDatabaseMissing('regimes_alimentaires', $this->donnees('regime_alimentaire'));

	$this->assertDatabaseHas('regimes_alimentaires', $this->donnees('regime_alimentaire_modifie'));
});
test('de la derniere connexion du user', function (): void {
	$date = new Carbon;

	$this->creationUser();

	unset($this->donnees_user['nom']);

	$this->post('/connexion', $this->donnees_user);

	unset($this->donnees_user['password']);

	$this->donnees_user['derniere_connexion'] = $date->now();

	$this->assertDatabaseHas('users', $this->donnees_user);
});

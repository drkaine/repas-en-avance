<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');
	$this->donnees_user_anonyme = $this->donnees('user_anonyme');
	$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');
	$this->donnes_carnet_recettes = $this->donnees('carnet_recette');
});
test('deconnexion', function (): void {
	$response = $this->get('deconnexion');

	$response->assertRedirect('/');
});
test('anonymisation user', function (): void {
	$this->userConnecte();

	$response = $this->get('/anonymisation-du-compte');

	$response->assertRedirect('deconnexion');
});
test('modification des donnees du user', function (): void {
	$this->userConnecte();

	unset($this->donnees_user['password']);

	$this->donnees_user['tags_regimes_alimentaires'] = [];

	$response = $this->post('/modification-user', $this->donnees_user);

	$response->assertRedirect('/');
});
test('recuperation compte', function (): void {
	$this->creation('User', 'user_anonyme');

	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertRedirect('/');
});
test('ajout carnet recettes', function (): void {
	$response = $this->post('/ajout-carnet-recettes', $this->donnes_carnet_recettes);

	$response->assertRedirect('/');
});
test('suppression carnet recettes', function (): void {
	$this->creation('CarnetRecette', 'carnet_recette');

	$response = $this->post('/suppression-carnet-recettes', $this->donnes_carnet_recettes);

	$response->assertRedirect('/');
});

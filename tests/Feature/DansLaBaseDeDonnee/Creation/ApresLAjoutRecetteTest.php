<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_recette = $this->donnees('recette');
	$this->donnees_ustensile = $this->donnees('ustensile');
	$this->donnees_mode_de_cuisson = $this->donnees('mode_de_cuisson');
	$this->donnees_ingredient = $this->donnees('ingredient');
	$this->donnees_photo = $this->donnees('photo');
	$this->donnees_auteur = $this->donnees('auteur');
	$this->auteur_non_user = $this->donnees('auteur_non_user');

	$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();

	$this->userConnecte();
});
test('recette', function (): void {
	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('ustensile dans ajout recette', function (): void {
	$this->donnees_formulaire_ajout_recette['ustensiles'] = [
		'Cuillière' => 2,
	];

	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('ustensiles', $this->donnees_ustensile);
});
test('mode de cuisson dans ajout recette', function (): void {
	$this->donnees_formulaire_ajout_recette['mode_de_cuissons'] = [
		'Four' => 2,
	];

	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('mode_de_cuissons', $this->donnees_mode_de_cuisson);
});
test('ingredient dans ajout recette', function (): void {
	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('ingredients', $this->donnees_ingredient);
});
test('photo dans ajout recette', function (): void {
	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('photos', $this->donnees_photo);
});
test('le user est l auteur et n existe pas', function (): void {
	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('auteurs', $this->donnees_auteur);
});
test('le user est l auteur et existe deja', function (): void {
	$this->creation('Auteur', 'auteur');

	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('auteurs', $this->donnees_auteur);

	$this->assertDatabaseCount('auteurs', 1);
});
test('le user n est pas l auteur et n existe pas', function (): void {
	$this->donnees_formulaire_ajout_recette['auteur'] = $this->auteur_non_user;

	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('auteurs', $this->auteur_non_user);
});
test('le user n est pas l auteur et existe', function (): void {
	$this->creation('Auteur', 'auteur_non_user');

	$this->donnees_formulaire_ajout_recette['auteur'] = $this->auteur_non_user;

	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('auteurs', $this->auteur_non_user);

	$this->assertDatabaseCount('auteurs', 1);
});
test('lien auteur et recette', function (): void {
	$auteur_recette = $this->donnees('auteur_recette');

	$this->creation('AuteurRecette', 'auteur_recette');

	$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$this->assertDatabaseHas('auteur_recettes', $auteur_recette);
});

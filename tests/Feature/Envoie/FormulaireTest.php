<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->creationTagsAjoutRecette();

	$this->donnees_user = $this->donnees('user');

	$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();

	$this->donnees_mot_de_passe_oublie = $this->donnees('mot_de_passe_oublie');

	$this->donnees_user_anonyme = $this->donnees('user');

	$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');

	$this->creation('User', 'user_anonyme');
});
test('inscription', function (): void {
	$this->creationRegimesAlimentaire();

	$this->donnees_user['password_confirmation'] = 'password';

	$this->donnees_user['regimes_alimentaires'] = [];

	$response = $this->post('/inscription', $this->donnees_user);

	$response->assertStatus(200);
});
test('connexion', function (): void {
	$this->creationUser();

	unset($this->donnees_user['nom']);

	$response = $this->post('/connexion', $this->donnees_user);

	$response->assertRedirect('/');
});
test('ajout tag', function (): void {
	$response = $this->post('/ajout-tag', [
		'nom' => 'Catégorie',
		'tags_parent' => [],
		'tags_enfant' => [],
	]);

	$response->assertStatus(200);
});
test('ajout recette', function (): void {
	$this->userConnecte();

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(200);
});
test('demande mot de passe oublie', function (): void {
	$this->creationUser();

	$response = $this->post('/demande-mot-de-passe-oublie', [
		'email' => 'email@test.fr',
	]);

	$response->assertStatus(200);
});
test('mot de passe oublie', function (): void {
	$this->creationUser();

	$response = $this->post('/mot-de-passe-oublie', $this->donnees_mot_de_passe_oublie);

	$response->assertStatus(200);
});
test('recuperation compte', function (): void {
	$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

	$response->assertRedirect('/');
});

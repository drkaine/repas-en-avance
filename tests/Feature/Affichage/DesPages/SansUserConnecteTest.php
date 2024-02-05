<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

test('accueil', function (): void {
	$response = $this->get('/');

	$response->assertStatus(200);
});
test('inscription', function (): void {
	$this->creationRegimesAlimentaire();

	$response = $this->get('inscription');

	$response->assertStatus(200);
});
test('connexion', function (): void {
	$response = $this->get('connexion');

	$response->assertStatus(200);
});
test('recuperation compte', function (): void {
	$response = $this->get('recuperation-compte');

	$response->assertStatus(200);
});
test('catalogue recettes', function (): void {
	$this->creation('Recette', 'recette');

	$this->creationDonnees('Tag', 'tag_ingredient');

	$this->creation('Ingredient', 'ingredient');

	$response = $this->get('catalogue-recettes');

	$response->assertStatus(200);
});
test('confirmation email', function (): void {
	$user = $this->creationUser();

	$response = $this->get('confirmation-email/' . $user->email);

	$response->assertStatus(200);
});
test('mot de passe oublie', function (): void {
	$response = $this->get('mot-de-passe-oublie/oigoiuyv');

	$response->assertStatus(200);
});
test('demande mot de passe oublie', function (): void {
	$response = $this->get('demande-mot-de-passe-oublie');

	$response->assertStatus(200);
});

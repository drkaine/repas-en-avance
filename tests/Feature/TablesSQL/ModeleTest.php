<?php

declare(strict_types = 1);
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');
	$this->donnees_tag = $this->donnees('tag');
	$this->donnees_recette = $this->donnees('recette');
	$this->donnees_carnet_recette = $this->donnees('carnet_recette');
	$this->donnees_auteur = $this->donnees('auteur');
});
test('users', function (): void {
	$this->donnees_user['email_verified_at'] = '2023-06-06 06:06:06';

	$this->donnees_user['derniere_connexion'] = '06-06-2023 06:06:06';

	$user = new User;

	$user->factory()->create($this->donnees_user);

	unset($this->donnees_user['password']);

	$this->assertDatabaseHas('users', $this->donnees_user);
});
test('tags', function (): void {
	$this->creation('Tag', 'tag');

	$this->assertDatabaseHas('tags', $this->donnees_tag);
});
test('relation tags', function (): void {
	$this->creation('RelationTag', 'relation_tag');

	$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag'));
});
test('recettes', function (): void {
	$this->creation('Recette', 'recette');

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('regime alimentaire', function (): void {
	$this->creation('RegimeAlimentaire', 'regime_alimentaire');

	$this->assertDatabaseHas('regimes_alimentaires', $this->donnees('regime_alimentaire'));
});
test('ingredient', function (): void {
	$this->creation('Ingredient', 'ingredient');

	$this->assertDatabaseHas('ingredients', $this->donnees('ingredient'));
});
test('ustensile', function (): void {
	$this->creation('Ustensile', 'ustensile');

	$this->assertDatabaseHas('ustensiles', $this->donnees('ustensile'));
});
test('mode de cuisson', function (): void {
	$this->creation('ModeDeCuisson', 'mode_de_cuisson');

	$this->assertDatabaseHas('mode_de_cuissons', $this->donnees('mode_de_cuisson'));
});
test('photo', function (): void {
	$this->creation('Photo', 'photo');

	$this->assertDatabaseHas('photos', $this->donnees('photo'));
});
test('carnet recettes', function (): void {
	$this->creation('CarnetRecette', 'carnet_recette');

	$this->assertDatabaseHas('carnet_recettes', $this->donnees_carnet_recette);
});
test('auteur', function (): void {
	$this->creation('Auteur', 'auteur');

	$this->assertDatabaseHas('auteurs', $this->donnees_auteur);
});
test('auteur recettes', function (): void {
	$donnees_auteur_recettes = $this->donnees('auteur_recette');

	$this->creation('AuteurRecette', 'auteur_recette');

	$this->assertDatabaseHas('auteur_recettes', $donnees_auteur_recettes);
});

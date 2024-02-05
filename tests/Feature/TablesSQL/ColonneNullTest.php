<?php

declare(strict_types = 1);

use App\Models\Auteur;
use App\Models\Recette;
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_user = $this->donnees('user');
	$this->donnees_recette = $this->donnees('recette');
	$this->donnees_auteur = $this->donnees('auteur');
});
test('de la table users champs email verified at', function (): void {
	$this->donnees_user['email_verified_at'] = null;

	creationUser($this->donnees_user);

	unset($this->donnees_user['password']);

	$this->assertDatabaseHas('users', $this->donnees_user);
});
test('de la table users champs derniere connexion', function (): void {
	$this->donnees_user['derniere_connexion'] = null;

	creationUser($this->donnees_user);

	unset($this->donnees_user['password']);

	$this->assertDatabaseHas('users', $this->donnees_user);
});
test('de la table recette champs temps cuisson', function (): void {
	$this->donnees_recette['temps_cuisson'] = null;

	creationRecette($this->donnees_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('de la table recette champs temps repos', function (): void {
	$this->donnees_recette['temps_repos'] = null;

	creationRecette($this->donnees_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('de la table recette champs lien', function (): void {
	$this->donnees_recette['lien'] = null;

	creationRecette($this->donnees_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('de la table recette champs instruction', function (): void {
	$this->donnees_recette['instruction'] = null;

	creationRecette($this->donnees_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('de la table recette champs description', function (): void {
	$this->donnees_recette['description'] = null;

	creationRecette($this->donnees_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('de la table recette champs reference livre', function (): void {
	$this->donnees_recette['reference_livre'] = null;

	creationRecette($this->donnees_recette);

	$this->assertDatabaseHas('recettes', $this->donnees_recette);
});
test('de la table auteur champs id user', function (): void {
	$this->donnees_auteur['id_user'] = null;

	$auteur = new Auteur;

	$auteur->factory()->create($this->donnees_auteur);

	$this->assertDatabaseHas('auteurs', $this->donnees_auteur);
});
function creationUser($donnees_user): void
{
	$user = new User;
	$user->factory()->create($donnees_user);
}
function creationRecette($donnees_recette): void
{
	$recette = new Recette;

	unset($donnees_recette['ingredients'], $donnees_recette['quantites']);

	$recette->factory()->create($donnees_recette);
}

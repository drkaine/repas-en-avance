<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();
});
test('champs nom', function (): void {
	$this->donnees_formulaire_ajout_recette['nom'] = null;

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('longueur maximum champs nom', function (): void {
	$this->donnees_formulaire_ajout_recette['nom'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('longueur minimum champs nom', function (): void {
	$this->donnees_formulaire_ajout_recette['nom'] = 'az';

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('champs description', function (): void {
	$this->donnees_formulaire_ajout_recette['description'] = null;

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('longueur minimum champs description', function (): void {
	$this->donnees_formulaire_ajout_recette['description'] = 'az';

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('champs temps de preparation', function (): void {
	$this->donnees_formulaire_ajout_recette['temps_preparation'] = null;

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('champs ingredient', function (): void {
	unset($this->donnees_formulaire_ajout_recette['ingredients']);

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('champs quantite', function (): void {
	unset($this->donnees_formulaire_ajout_recette['quantitees']);

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});
test('champs photo', function (): void {
	unset($this->donnees_formulaire_ajout_recette['photos']);

	$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

	$response->assertStatus(302);
});

<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

uses(Tests\Traits\ModelDeTestTrait::class);

beforeEach(function (): void {
	$this->donnes_carnet_recettes = $this->donnees('carnet_recette');
});
test('ajout', function (): void {
	$this->post('/ajout-carnet-recettes', $this->donnes_carnet_recettes);

	$this->assertDatabaseHas('carnet_recettes', $this->donnes_carnet_recettes);
});
test('suppression', function (): void {
	$this->creation('CarnetRecette', 'carnet_recette');

	$this->post('/suppression-carnet-recettes', $this->donnes_carnet_recettes);

	$this->assertDatabaseMissing('carnet_recettes', $this->donnes_carnet_recettes);
});

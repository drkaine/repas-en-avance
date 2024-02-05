<?php

declare(strict_types = 1);
test('mon compte', function (): void {
	$response = $this->get('mon-compte');

	$response->assertRedirect('inscription');
});
test('ajout tag', function (): void {
	$response = $this->get('ajout-tag');

	$response->assertRedirect('inscription');
});
test('ajout recette', function (): void {
	$response = $this->get('ajout-recette');

	$response->assertRedirect('inscription');
});
test('carnet recettes', function (): void {
	$response = $this->get('carnet-recettes');

	$response->assertRedirect('connexion');
});

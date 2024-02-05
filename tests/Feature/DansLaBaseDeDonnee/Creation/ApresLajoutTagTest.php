<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

beforeEach(function (): void {
	$this->donnees_tag = $this->donnees('tag');
});
test('tag', function (): void {
	$this->post('/ajout-tag', $this->donnees_tag);

	$this->assertDatabaseHas('tags', $this->donnees_tag);
});
test('relation tag parent', function (): void {
	$this->creation('Tag', 'tag');

	$this->donnees_tag = [
		'nom' => 'Plat',
		'tags_parent' => [
			'1',
		],
		'tags_enfant' => null,
	];

	$this->post('/ajout-tag', $this->donnees_tag);

	$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag'));
});
test('relation tag enfant', function (): void {
	$this->creation('Tag', 'tag');

	$this->donnees_tag = [
		'nom' => 'Plat',
		'tags_parent' => null,
		'tags_enfant' => [
			'1',
		],
	];

	$this->post('/ajout-tag', $this->donnees_tag);

	$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag_inverse'));
});

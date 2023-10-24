<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage\DesPages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class AvecUserConnecteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	protected function setUp(): void
	{
		parent::setUp();

		$this->userConnecte();
	}

	public function testAjoutTag(): void
	{
		$this->creation('Tag', 'tag');

		$response = $this->get('ajout-tag');

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$this->creationTagsAjoutRecette();

		$response = $this->get('ajout-recette');

		$response->assertStatus(200);
	}

	public function testMonCompte(): void
	{
		$this->creationRegimesAlimentaire();

		$response = $this->get('mon-compte');

		$response->assertStatus(200);
	}

	public function testCarnetDeRecettes(): void
	{
		$this->creation('Recette', 'recette');

		$this->creationDonnees('Tag', 'tag_ingredient');

		$this->creation('Ingredient', 'ingredient');

		$this->creation('CarnetRecette', 'carnet_recette');

		$response = $this->get('carnet-recettes');

		$response->assertStatus(200);
	}
}

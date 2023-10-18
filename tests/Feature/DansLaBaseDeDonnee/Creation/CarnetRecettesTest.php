<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\Creation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class CarnetRecettesTest extends TestCase
{
	use RefreshDatabase;
	use RecuperationDonneesDeTestTrait;
	use ModelDeTestTrait;

	private array $donnes_carnet_recettes;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnes_carnet_recettes = $this->donnees('carnet_recette');
	}

	public function testAjout(): void
	{
		$this->post('/ajout-carnet-recettes', $this->donnes_carnet_recettes);

		$this->assertDatabaseHas('carnet_recettes', $this->donnes_carnet_recettes);
	}

	public function testSuppression(): void
	{
		$this->creation('CarnetRecette', 'carnet_recette');

		$this->post('/suppression-carnet-recettes', $this->donnes_carnet_recettes);

		$this->assertDatabaseMissing('carnet_recettes', $this->donnes_carnet_recettes);
	}
}

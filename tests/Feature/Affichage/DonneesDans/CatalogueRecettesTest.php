<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class CatalogueRecettesTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	public function testRecetteDansCatalogueRecettes(): void
	{
		$this->creationRecette();

		$response = $this->get('catalogue-recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			$response->assertSee($recette->temps_preparation);

			$response->assertSee($recette->nom);

			$response->assertSee($recette->temps_cuisson);

			$response->assertSee($recette->temps_repos);
		}
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class RecetteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	protected function setUp(): void
	{
		parent::setUp();

		$this->creationTagsAjoutRecette();
		$this->creation('Recette', 'recette');
		$this->creation('Photo', 'photo');
		$this->creationFichierPhoto();
	}

	public function testElementRecetteCarotteSimple(): void
	{
		$response = $this->get('recette/carotte-simple');

		$recette = $response->viewData('recette');

		$response->assertSee($recette->temps_preparation);
		$response->assertSee($recette->temps_cuisson);
		$response->assertSee($recette->temps_repos);
		$response->assertSee($recette->lien);
		$response->assertSee($recette->instruction);
		$response->assertSee($recette->description);
		$response->assertSee($recette->reference_livre);
		$response->assertSee($recette->nom);
	}

	public function testPhotoRecetteCarotteSimple(): void
	{
		$response = $this->get('recette/carotte-simple');

		$recette = $response->viewData('recette');

		foreach ($recette->recuperationPhoto as $photo) {
			$response->assertSee($photo->nom);
			$response->assertSee($photo->description);
			$response->assertSee($photo->dossier);
		}
	}
}

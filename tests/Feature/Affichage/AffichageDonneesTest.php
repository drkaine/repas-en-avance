<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class AffichageDonneesTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	public function testTagDansAjoutTag(): void
	{
		$this->userConnecte();

		$this->creationTag();

		$response = $this->get('/ajout-tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}

	public function testUserDansMonCompte(): void
	{
		$this->creationRegimesAlimentaire();

		$this->userConnecte();

		$response = $this->get('mon-compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}

	public function testTagDansLInscription(): void
	{
		$this->creationRegimesAlimentaire();

		$response = $this->get('inscription');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagDansMonCompte(): void
	{
		$this->creationRegimesAlimentaire();

		$this->userConnecte();

		$response = $this->get('mon-compte');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagUserDansMonCompte(): void
	{
		$this->creationRegimesAlimentaire();

		$this->userConnecte();

		$this->creationTagsUser();

		$response = $this->get('mon-compte');

		$tags_user = $response->viewData('tags_user');

		foreach ($tags_user as $tag_user) {
			$response->assertSee($tag_user->nom);

			$response->assertSee($tag_user->id);
		}
	}

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

	public function testUstensileDansAjoutRecette(): void
	{
		$this->creationTagsAjoutRecette();

		$this->userConnecte();

		$response = $this->get('ajout-recette');

		$ustensiles = $response->viewData('ustensiles');

		foreach ($ustensiles as $ustensile) {
			$response->assertSee($ustensile->nom);
		}
	}

	public function testModeDeCuissonDansAjoutRecette(): void
	{

		$this->creationTagsAjoutRecette();

		$this->userConnecte();

		$response = $this->get('ajout-recette');

		$mode_de_cuissons = $response->viewData('mode_de_cuissons');

		foreach ($mode_de_cuissons as $mode_de_cuisson) {
			$response->assertSee($mode_de_cuisson->nom);
		}
	}

	public function testIngredientDansAjoutRecette(): void
	{

		$this->creationTagsAjoutRecette();

		$this->userConnecte();

		$response = $this->get('ajout-recette');

		$ingredients = $response->viewData('ingredients');

		foreach ($ingredients as $ingredient) {
			$response->assertSee($ingredient->nom);
		}
	}
}

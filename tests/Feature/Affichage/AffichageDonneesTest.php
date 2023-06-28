<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class AffichageDonneesTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	public function testTagDansAjoutTag(): void
	{
		$this->userConnecte();

		$this->tag();

		$response = $this->get('/ajout_tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}

	public function testUserDansMonCompte(): void
	{
		$this->regimesAlimentaire();

		$this->userConnecte();

		$response = $this->get('mon_compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}

	public function testTagDansLInscription(): void
	{
		$this->regimesAlimentaire();

		$response = $this->get('inscription');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagDansMonCompte(): void
	{
		$this->regimesAlimentaire();

		$this->userConnecte();

		$response = $this->get('mon_compte');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagUserDansMonCompte(): void
	{
		$this->regimesAlimentaire();

		$this->userConnecte();

		$this->tagsUser();

		$response = $this->get('mon_compte');

		$tags_user = $response->viewData('tags_user');

		foreach ($tags_user as $tag_user) {
			$response->assertSee($tag_user->nom);

			$response->assertSee($tag_user->id);
		}
	}

	public function testRecettesDansRecettes(): void
	{
		$this->recette();

		$this->userConnecte();

		$this->tagsUser();

		$response = $this->get('recettes');

		$recettes = $response->viewData('recettes');

		foreach ($recettes as $recette) {
			$response->assertSee($recette->temps_preparation);

			$response->assertSee($recette->nom);

			$response->assertSee($recette->temps_cuisson);

			$response->assertSee($recette->temps_repos);

			$response->assertSee($recette->lien);

			$response->assertSee($recette->instruction);

			$response->assertSee($recette->description);

			$response->assertSee($recette->reference_livre);

			$response->assertSee($recette->id);
		}
	}
}

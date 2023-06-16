<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class AffichageDonneeDeLaVueTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	public function testTagDansLaPageAjoutTag(): void
	{
		$this->userConnecte();

		Tag::factory()->create($this->tag);

		$response = $this->get('/ajout_tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}

	public function testDonneeUserMonCompte(): void
	{
		$this->regimeAlimentaire();

		$this->userConnecte();

		$response = $this->get('mon_compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}

	public function testTagDansLInscription(): void
	{
		$this->regimeAlimentaire();

		$response = $this->get('inscription');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagDansMonCompte(): void
	{
		$this->regimeAlimentaire();

		$this->userConnecte();

		$response = $this->get('mon_compte');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}
}

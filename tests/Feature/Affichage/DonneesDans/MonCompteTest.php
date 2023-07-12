<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class MonCompteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	protected function setUp(): void
	{
		parent::setUp();
		$this->creationRegimesAlimentaire();

		$this->userConnecte();
	}

	public function testUserDansMonCompte(): void
	{
		$response = $this->get('mon-compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}

	public function testTagDansMonCompte(): void
	{
		$response = $this->get('mon-compte');

		$tags_regimes_alimentaires = $response->viewData('tags_regimes_alimentaires');

		foreach ($tags_regimes_alimentaires as $tag_regime_alimentaire) {
			$response->assertSee($tag_regime_alimentaire->nom);

			$response->assertSee($tag_regime_alimentaire->id);
		}
	}

	public function testRegimeAlimentaireDansMonCompte(): void
	{
		$this->creationRegimeAlimentaire();

		$response = $this->get('mon-compte');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}
}

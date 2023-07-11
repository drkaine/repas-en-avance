<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class DansLInscriptionTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	protected function setUp(): void
	{
		parent::setUp();
		$this->creationRegimesAlimentaire();
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
}

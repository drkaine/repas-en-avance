<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage\DesPages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class SansConditionDeConnexionTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	protected function setUp(): void
	{
		parent::setUp();
		$this->creationTagsAjoutRecette();
		$this->creation('Recette', 'recette');
	}

	public function testRecette(): void
	{
		$response = $this->get('recette/carotte-simple');

		$response->assertStatus(200);
	}
}

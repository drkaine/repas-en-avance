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
		$this->creationTag();

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
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage\Donnees;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class AjoutTagTest extends TestCase
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
}

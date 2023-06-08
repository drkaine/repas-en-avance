<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AffichageDonneeDeLaVueTest extends TestCase
{
	use RefreshDatabase;

	public function testTagDansLaPageAjoutTag(): void
	{
		Tag::factory()->create(['nom' => 'Catégorie', ]);

		$response = $this->get('/ajout_tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}
}

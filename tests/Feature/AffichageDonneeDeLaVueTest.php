<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AffichageDonneeDeLaVueTest extends TestCase
{
	use RefreshDatabase;

	private array $tag;

	private array $user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->tag = config('donnee_de_test.tag');

		$this->user = config('donnee_de_test.user');
	}

	public function testTagDansLaPageAjoutTag(): void
	{
		Tag::factory()->create($this->tag);

		$response = $this->get('/ajout_tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}

	public function testDonneeUserConnecte(): void
	{
		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		$response = $this->get('mon_compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\Affichage;

use App\Models\RelationTag;
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
		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		Tag::factory()->create($this->tag);

		$response = $this->get('/ajout_tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}

	public function testDonneeUserMonCompte(): void
	{
		Tag::factory()->create([
			'nom' => 'Régime alimentaire',
		]);

		Tag::factory()->create([
			'nom' => 'Végan',
		]);

		RelationTag::factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);

		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		$response = $this->get('mon_compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}

	public function testTagDansLInscription(): void
	{
		Tag::factory()->create([
			'nom' => 'Régime alimentaire',
		]);

		Tag::factory()->create([
			'nom' => 'Végan',
		]);

		RelationTag::factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);

		$response = $this->get('inscription');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagDansMonCompte(): void
	{
		Tag::factory()->create([
			'nom' => 'Régime alimentaire',
		]);

		Tag::factory()->create([
			'nom' => 'Végan',
		]);

		RelationTag::factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);

		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		$response = $this->get('mon_compte');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}
}

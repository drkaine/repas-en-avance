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
		$this->creationUserConnecte();

		Tag::factory()->create($this->tag);

		$response = $this->get('/ajout_tag');

		$tags = $response->viewData('tags');

		foreach ($tags as $tag) {
			$response->assertSee($tag->nom);
		}
	}

	public function testDonneeUserMonCompte(): void
	{
		$this->creationRegimeAlimentaire();

		$this->creationUserConnecte();

		$response = $this->get('mon_compte');

		$donnee_user = $response->viewData('user');

		$response->assertSee($donnee_user->nom);

		$response->assertSee($donnee_user->email);
	}

	public function testTagDansLInscription(): void
	{
		$this->creationRegimeAlimentaire();

		$response = $this->get('inscription');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	public function testTagDansMonCompte(): void
	{
		$this->creationRegimeAlimentaire();

		$this->creationUserConnecte();

		$response = $this->get('mon_compte');

		$regimes_alimentaires = $response->viewData('regimes_alimentaires');

		foreach ($regimes_alimentaires as $regime_alimentaire) {
			$response->assertSee($regime_alimentaire->nom);

			$response->assertSee($regime_alimentaire->id);
		}
	}

	private function creationRegimeAlimentaire(): void
	{
		$tag = new Tag;

		$tag->factory()->create([
			'nom' => 'Régime alimentaire',
		]);

		$tag->factory()->create([
			'nom' => 'Végan',
		]);

		$relation_tag = new RelationTag;

		$relation_tag->factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);
	}

	private function creationUserConnecte(): void
	{
		$user = new User;

		$user = $user->factory()->create($this->user);

		$this->actingAs($user);
	}
}

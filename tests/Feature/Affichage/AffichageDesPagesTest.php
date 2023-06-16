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
class AffichageDesPagesTest extends TestCase
{
	use RefreshDatabase;

	private array $user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
	}

	public function testAccueil(): void
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testInscription(): void
	{
		$this->creationRegimeAlimentaire();

		$response = $this->get('inscription');

		$response->assertStatus(200);
	}

	public function testConnexion(): void
	{
		$response = $this->get('connexion');

		$response->assertStatus(200);
	}

	public function testAjoutTag(): void
	{
		$this->creationUserConnecte();

		$tag = new Tag;

		$tag->factory()->create(['nom' => 'Catégorie', ]);

		$response = $this->get('ajout_tag');

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$this->creationUserConnecte();

		$response = $this->get('ajout_recette');

		$response->assertStatus(200);
	}

	public function testMonCompte(): void
	{
		$this->creationUserConnecte();

		$this->creationRegimeAlimentaire();

		$response = $this->get('mon_compte');

		$response->assertStatus(200);
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

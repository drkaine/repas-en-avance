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

		$response->assertStatus(200);
	}

	public function testConnexion(): void
	{
		$response = $this->get('connexion');

		$response->assertStatus(200);
	}

	public function testAjoutTag(): void
	{
		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		Tag::factory()->create(['nom' => 'Catégorie', ]);

		$response = $this->get('ajout_tag');

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		$response = $this->get('ajout_recette');

		$response->assertStatus(200);
	}

	public function testMonCompte(): void
	{
		$user = User::factory()->create($this->user);

		$this->actingAs($user);

		$response = $this->get('mon_compte');

		$response->assertStatus(200);
	}
}

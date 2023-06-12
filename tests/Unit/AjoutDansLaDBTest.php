<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AjoutDansLaDBTest extends TestCase
{
	use RefreshDatabase;

	private array $user;

	private array $tag;

	private array $recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
		$this->tag = config('donnee_de_test.tag');
		$this->recette = config('donnee_de_test.recette');
	}

	public function testCreationDUnUserApresLInscription(): void
	{
		$this->user['password_confirmation'] = 'password';

		$this->post('/inscription', $this->user);

		unset($this->user['password'], $this->user['password_confirmation']);

		$this->assertDatabaseHas('users', $this->user);
	}

	public function testCreationDUnTag(): void
	{
		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('tags', $this->tag);
	}

	public function testCreationDUneRelationTagParent(): void
	{
		Tag::factory()->create($this->tag);

		$this->tag = [
			'nom' => 'Plat',
			'nom_tags_parent' => [
				'Catégorie',
			],
			'nom_tags_enfant' => [],
		];

		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('relation_tags', [
			'nom_tag_parent' => 'Catégorie',
			'nom_tag_enfant' => 'Plat',
		]);
	}

	public function testCreationDUneRelationTagEnfant(): void
	{
		Tag::factory()->create($this->tag);

		$this->tag = [
			'nom' => 'Plat',
			'nom_tags_parent' => [],
			'nom_tags_enfant' => [
				'Catégorie',
			],
		];

		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('relation_tags', [
			'nom_tag_parent' => 'Plat',
			'nom_tag_enfant' => 'Catégorie',
		]);
	}

	public function testCreationDUneRecette(): void
	{
		$this->post('/ajout_recette', $this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}
}

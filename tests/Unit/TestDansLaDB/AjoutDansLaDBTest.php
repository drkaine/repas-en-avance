<?php

declare(strict_types = 1);

namespace Tests\Unit\TestDansLaDB;

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
			'id_tags_parent' => [
				1,
			],
			'id_tags_enfant' => [],
		];

		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('relation_tags', [
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);
	}

	public function testCreationDUneRelationTagEnfant(): void
	{
		Tag::factory()->create($this->tag);

		$this->tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [],
			'id_tags_enfant' => [
				1,
			],
		];

		$this->post('/ajout_tag', $this->tag);

		$this->assertDatabaseHas('relation_tags', [
			'id_tag_parent' => 2,
			'id_tag_enfant' => 1,
		]);
	}

	public function testCreationDUneRecette(): void
	{
		$this->post('/ajout_recette', $this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}
}

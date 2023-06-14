<?php

declare(strict_types = 1);

namespace Tests\Unit\TableSQL;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\TagUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ModeleDesTablesSQLTest extends TestCase
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

	public function testDeLaTableUsers(): void
	{
		$this->user['email_verified_at'] = '2023-06-06 06:06:06';

		$this->user['derniere_connexion'] = '06-06-2023 06:06:06';

		User::factory()->create($this->user);

		unset($this->user['password']);

		$this->assertDatabaseHas('users', $this->user);
	}

	public function testDeLaTableTags(): void
	{
		Tag::factory()->create($this->tag);

		$this->assertDatabaseHas('tags', $this->tag);
	}

	public function testDeLaTableRelationTags(): void
	{
		Tag::factory()->create($this->tag);
		Tag::factory()->create(['nom' => 'Plat', ]);

		$relation_tag = [
			'nom_tag_parent' => 'Catégorie',
			'nom_tag_enfant' => 'Plat',
		];

		RelationTag::factory()->create($relation_tag);

		$this->assertDatabaseHas('relation_tags', $relation_tag);
	}

	public function testDeLaTableRecettes(): void
	{
		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testDeLaTableTagsUser(): void
	{
		User::factory()->create($this->user);

		Tag::factory()->create($this->tag);

		TagUser::factory()->create([
			'id_user' => 1,
			'id_tag' => 1,
		]);

		$this->assertDatabaseHas('tags_user', [
			'id_user' => 1,
			'id_tag' => 1,
		]);
	}
}

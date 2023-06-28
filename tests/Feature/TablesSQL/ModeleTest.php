<?php

declare(strict_types = 1);

namespace Tests\Feature\TableSQL;

use App\Models\RelationTag;
use App\Models\TagUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class ModeleTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

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

	public function testUsers(): void
	{
		$this->user['email_verified_at'] = '2023-06-06 06:06:06';

		$this->user['derniere_connexion'] = '06-06-2023 06:06:06';

		User::factory()->create($this->user);

		unset($this->user['password']);

		$this->assertDatabaseHas('users', $this->user);
	}

	public function testTags(): void
	{
		$this->tag();

		$this->assertDatabaseHas('tags', $this->tag);
	}

	public function testRelationTags(): void
	{
		$relation_tag = [
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		];

		RelationTag::factory()->create($relation_tag);

		$this->assertDatabaseHas('relation_tags', $relation_tag);
	}

	public function testRecettes(): void
	{
		$this->recette();

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testTagsUser(): void
	{
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

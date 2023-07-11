<?php

declare(strict_types = 1);

namespace Tests\Feature\TableSQL;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class ModeleTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_tag;

	private array $donnees_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
		$this->donnees_tag = $this->donneesTag();
		$this->donnees_recette = $this->donneesRecette();
	}

	public function testUsers(): void
	{
		$this->donnees_user['email_verified_at'] = '2023-06-06 06:06:06';

		$this->donnees_user['derniere_connexion'] = '06-06-2023 06:06:06';

		$user = new User;

		$user->factory()->create($this->donnees_user);

		unset($this->donnees_user['password']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testTags(): void
	{
		$this->creationTag();

		$this->assertDatabaseHas('tags', $this->donnees_tag);
	}

	public function testRelationTags(): void
	{
		$this->creationRelationTag();

		$this->assertDatabaseHas('relation_tags', $this->donneesRelationTag());
	}

	public function testRecettes(): void
	{
		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testTagsUser(): void
	{
		$this->creationTagsUser();

		$this->assertDatabaseHas('tags_user', $this->donneesTagUser());
	}

	public function testTagsRecette(): void
	{
		$this->creationTagsRecetteIngredient();

		$this->assertDatabaseHas('tags_recette', $this->donneesTagRecetteIngredient());
	}

	public function testIngredient(): void
	{
		$this->creationIngredient();

		$this->assertDatabaseHas('ingredients', $this->donneesTagRecetteIngredient());
	}
}

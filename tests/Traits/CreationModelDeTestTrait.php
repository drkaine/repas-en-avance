<?php

declare(strict_types = 1);

namespace Tests\Traits;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\TagUser;
use App\Models\User;

trait CreationModelDeTestTrait
{
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

	public function userConnecte(): void
	{
		$user = $this->user();

		$this->actingAs($user);
	}

	public function user(): User
	{
		$user = new User;

		$user = $user->factory()->create($this->user);

		return $user;
	}

	public function tag(): void
	{
		$tag = new Tag;

		$tag->factory()->create($this->tag);
	}

	public function recette(): void
	{
		$recette = new Recette;

		$recette->factory()->create($this->recette);
	}

	public function regimeAlimentaire(): void
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

	public function tagsUser(): void
	{
		$tags_user = new TagUser;

		$tags_user->factory()->create([
			'id_user' => 1,
			'id_tag' => 2,
		]);
	}
}

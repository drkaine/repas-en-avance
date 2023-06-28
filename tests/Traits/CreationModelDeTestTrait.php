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
	use RecuperationDonneesDeTestTrait;

	public function userConnecte(): void
	{
		$user = $this->user();

		$this->actingAs($user);
	}

	public function user(): User
	{
		$user = new User;

		$user = $user->factory()->create($this->donneesUser());

		return $user;
	}

	public function tag(): void
	{
		$tag = new Tag;

		$tag->factory()->create($this->donneesTag());
	}

	public function recette(): void
	{
		$recette = new Recette;

		$recette->factory()->create($this->donneesRecette());
	}

	public function regimesAlimentaire(): void
	{
		$this->tagsRegimesAlimentaire();

		$this->relationTags();
	}

	public function tagsUser(): void
	{
		$tags_user = new TagUser;

		$tags_user->factory()->create([
			'id_user' => 1,
			'id_tag' => 2,
		]);
	}

	public function tagsRegimesAlimentaire(): void
	{
		$tag = new Tag;

		foreach ($this->donneesTagsRegimesAlimentaire() as $tag_regime_alimentaire) {
			$tag->factory()->create($tag_regime_alimentaire);
		}
	}

	public function relationTags(): void
	{
		$relation_tag = new RelationTag;

		$relation_tag->factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		]);

		$relation_tag->factory()->create([
			'id_tag_parent' => 1,
			'id_tag_enfant' => 3,
		]);
	}
}

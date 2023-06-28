<?php

declare(strict_types = 1);

namespace Tests\Traits;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\TagUser;
use App\Models\User;

trait ModelDeTestTrait
{
	use RecuperationDonneesDeTestTrait;

	public function userConnecte(): void
	{
		$user = $this->creationUser();

		$this->actingAs($user);
	}

	public function creationUser(): User
	{
		$user = new User;

		$user = $user->factory()->create($this->donneesUser());

		return $user;
	}

	public function creationTag(): void
	{
		$tag = new Tag;

		$tag->factory()->create($this->donneesTag());
	}

	public function creationRecette(): void
	{
		$recette = new Recette;

		$recette->factory()->create($this->donneesRecette());
	}

	public function creationregimesAlimentaire(): void
	{
		$this->creationTagsRegimesAlimentaire();

		$this->creationRelationTags();
	}

	public function creationTagsUser(): void
	{
		$tags_user = new TagUser;

		$tags_user->factory()->create([
			'id_user' => 1,
			'id_tag' => 2,
		]);
	}

	public function creationTagsRegimesAlimentaire(): void
	{
		$tag = new Tag;

		foreach ($this->donneesTagsRegimesAlimentaire() as $tag_regime_alimentaire) {
			$tag->factory()->create($tag_regime_alimentaire);
		}
	}

	public function creationRelationTags(): void
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

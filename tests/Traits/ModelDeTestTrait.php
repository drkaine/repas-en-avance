<?php

declare(strict_types = 1);

namespace Tests\Traits;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\TagRecette;
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

	public function creationUserAnonyme(): void
	{
		$user = new User;

		$user = $user->factory()->create($this->donneesUserAnonyme());
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
		$tag_user = new TagUser;

		$tag_user->factory()->create($this->donneesTagUser());
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

		foreach ($this->donneesRelationTags() as $donnees_relation_tag) {
			$relation_tag->factory()->create($donnees_relation_tag);
		}
	}

	public function creationRelationTag(): void
	{
		$relation_tag = new RelationTag;

		$relation_tag->factory()->create($this->donneesRelationTag());
	}

	public function creationTagsRecette(): void
	{
		$tag_recette = new TagRecette;

		$tag_recette->factory()->create($this->donneesTagRecette());
	}

	public function creationTagsAjoutRecette(): void
	{
		$this->creationTagModeDeCuisson();

		$this->creationTagUstensile();

		$this->creationRelationTags();

		$this->creationTagIngredient();
	}

	public function creationTagUstensile(): void
	{
		$tag = new Tag;

		foreach ($this->donneesUstensile() as $ustensile) {
			$tag->factory()->create($ustensile);
		}
	}

	public function creationTagModeDeCuisson(): void
	{
		$tag = new Tag;

		foreach ($this->donneesModeDeCuisson() as $mode_de_cuisson) {
			$tag->factory()->create($mode_de_cuisson);
		}
	}

	public function creationTagIngredient(): void
	{
		$tag = new Tag;

		foreach ($this->donneesIngredient() as $ingredient) {
			$tag->factory()->create($ingredient);
		}
	}
}

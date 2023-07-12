<?php

declare(strict_types = 1);

namespace Tests\Traits;

use App\Models\Ingredient;
use App\Models\ModeDeCuisson;
use App\Models\Recette;
use App\Models\RegimeAlimentaire;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ustensile;

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

		$user = $user->factory()->create($this->donnees('user'));

		return $user;
	}

	public function creationUserAnonyme(): void
	{
		$user = new User;

		$user = $user->factory()->create($this->donnees('user_anonyme'));
	}

	public function creationTag(): void
	{
		$tag = new Tag;

		$tag->factory()->create($this->donnees('tag'));
	}

	public function creationRecette(): void
	{
		$recette = new Recette;

		$recette->factory()->create($this->donnees('recette'));
	}

	public function creationregimesAlimentaire(): void
	{
		$this->creationTagsRegimesAlimentaire();

		$this->creationRelationTags();
	}

	public function creationRegimeAlimentaire(): void
	{
		$regime_alimentaire = new RegimeAlimentaire;

		$regime_alimentaire->factory()->create($this->donnees('regime_alimentaire'));
	}

	public function creationTagsRegimesAlimentaire(): void
	{
		$tag = new Tag;

		foreach ($this->donnees('tags_regimes_alimentaire') as $tag_regime_alimentaire) {
			$tag->factory()->create($tag_regime_alimentaire);
		}
	}

	public function creationRelationTags(): void
	{
		$relation_tag = new RelationTag;

		foreach ($this->donnees('relation_tags') as $donnees_relation_tag) {
			$relation_tag->factory()->create($donnees_relation_tag);
		}
	}

	public function creationRelationTag(): void
	{
		$relation_tag = new RelationTag;

		$relation_tag->factory()->create($this->donnees('relation_tag'));
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

		foreach ($this->donnees('tag_ustensile') as $ustensile) {
			$tag->factory()->create($ustensile);
		}
	}

	public function creationTagModeDeCuisson(): void
	{
		$tag = new Tag;

		foreach ($this->donnees('tag_mode_de_cuisson') as $mode_de_cuisson) {
			$tag->factory()->create($mode_de_cuisson);
		}
	}

	public function creationTagIngredient(): void
	{
		$tag = new Tag;

		foreach ($this->donnees('tag_ingredient') as $ingredient) {
			$tag->factory()->create($ingredient);
		}
	}

	public function creationIngredient(): void
	{
		$ingredient = new Ingredient;

		$ingredient->factory()->create($this->donnees('ingredient'));
	}

	public function creationUstensile(): void
	{
		$ustensile = new Ustensile;

		$ustensile->factory()->create($this->donnees('ustensile'));
	}

	public function creationModeDeCuisson(): void
	{
		$ustensile = new ModeDeCuisson;

		$ustensile->factory()->create($this->donnees('mode_de_cuisson'));
	}
}

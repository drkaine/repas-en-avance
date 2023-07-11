<?php

declare(strict_types = 1);

namespace Tests\Traits;

trait RecuperationDonneesDeTestTrait
{
	public function donneesUser(): array
	{
		return config('donnee_de_test.user');
	}

	public function donneesUserAnonyme(): array
	{
		return config('donnee_de_test.user_anonyme');
	}

	public function donneesUserAnonymeRecupere(): array
	{
		return config('donnee_de_test.user_anonyme_recupere');
	}

	public function donneesUserModifie(): array
	{
		return config('donnee_de_test.user_modifie');
	}

	public function donneesTagsRegimesAlimentaire(): array
	{
		return config('donnee_de_test.tags_regimes_alimentaire');
	}

	public function donneesTag(): array
	{
		return config('donnee_de_test.tag');
	}

	public function donneesRecette(): array
	{
		return config('donnee_de_test.recette');
	}

	public function donneesRelationTags(): array
	{
		return config('donnee_de_test.relation_tags');
	}

	public function donneesRelationTag(): array
	{
		return config('donnee_de_test.relation_tag');
	}

	public function donneesRelationTagInverse(): array
	{
		return config('donnee_de_test.relation_tag_inverse');
	}

	public function donneesTagUser(): array
	{
		return config('donnee_de_test.tag_user');
	}

	public function donneesTagUserModifie(): array
	{
		return config('donnee_de_test.tag_user_modifie');
	}

	public function donneesUstensile(): array
	{
		return config('donnee_de_test.ustensile');
	}

	public function donneesModeDeCuisson(): array
	{
		return config('donnee_de_test.mode_de_cuisson');
	}

	public function donneesIngredient(): array
	{
		return config('donnee_de_test.ingredient');
	}

	public function donneesTagUstensile(): array
	{
		return config('donnee_de_test.tag_ustensile');
	}

	public function donneesTagModeDeCuisson(): array
	{
		return config('donnee_de_test.tag_mode_de_cuisson');
	}

	public function donneesTagIngredient(): array
	{
		return config('donnee_de_test.tag_ingredient');
	}
}

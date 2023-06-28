<?php

declare(strict_types = 1);

namespace Tests\Traits;

trait RecuperationDonneesDeTestTrait
{
	public function donneesUser(): array
	{
		return config('donnee_de_test.user');
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
}

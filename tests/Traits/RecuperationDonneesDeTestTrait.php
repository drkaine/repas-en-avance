<?php

declare(strict_types = 1);

namespace Tests\Traits;

trait RecuperationDonneesDeTestTrait
{
	public function donnees(string $donnee_voulue): array
	{
		return config('donnee_de_test.' . $donnee_voulue);
	}
}

<?php

declare(strict_types = 1);

namespace App\Traits;

trait ValidationFormulaireTrait
{
	public function recuperationDonneesAValider(string $formulaire_voulu): array
	{
		return config('validation_formulaire.' . $formulaire_voulu);
	}
}

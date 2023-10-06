<?php

declare(strict_types = 1);

namespace Tests\Traits;

use Illuminate\Http\Testing\File;

trait RecuperationDonneesDeTestTrait
{
	public function donnees(string $donnee_voulue): File | array
	{
		return config('donnee_de_test.' . $donnee_voulue);
	}

	public function donneesFormulaireAjoutRecette(): array
	{
		$donnees_recette = $this->donnees('recette');
		$donnees_recette['ingredients'] = [
			'Carotte' => '2',
		];

		$donnees_recette['quantitees'] = [
			'2' => '1',
		];

		$donnees_recette['photos'] = $this->donnees('fichier_photo');

		return $donnees_recette;
	}
}

<?php

declare(strict_types = 1);

namespace App\Services;

use App\Traits\GestionDB\SelectTrait;
use Illuminate\Database\Eloquent\Collection;

class GestionAffichageService
{
	use SelectTrait;

	public function recetteAjoutee(array $id_recette): array
	{
		$user = auth()->user();

		$id_recettes = [];

		if ($user) {
			$recettes_ajoutees = $this->carnetRecetteParIdUserEtListIdRecette($user->id, $id_recette);

			$id_recettes = $this->recupererIdRecettesAjoutees($recettes_ajoutees);
		}

		return $id_recettes;
	}

	private function recupererIdRecettesAjoutees(Collection $recettes_ajoutees): array
	{
		$id_recettes = [];

		foreach ($recettes_ajoutees as $recette_ajoutee) {
			$id_recettes[] = $recette_ajoutee->id_recette;
		}

		return $id_recettes;
	}
}

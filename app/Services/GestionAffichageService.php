<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\CarnetRecette;

class GestionAffichageService
{
	public function recetteAjoutee(array $id_recette): array
	{
		$user = auth()->user();

		$id_recettes = [];

		if ($user) {
			$carnet_recette = new CarnetRecette;

			$recettes_ajoutees = $carnet_recette->
				select('id_recette')->
				where('id_user', $user->id)->
				whereIn('id_recette', $id_recette)->
				get();

			foreach ($recettes_ajoutees as $recette_ajoutee) {
				$id_recettes[] = $recette_ajoutee->id_recette;
			}
		}

		return $id_recettes;
	}
}

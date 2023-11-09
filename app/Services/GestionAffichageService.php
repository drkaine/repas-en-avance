<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\CarnetRecette;

class GestionAffichageService
{
	public function recetteAjoutee(int $id_recette): bool
	{
		$user = auth()->user();

		$recette_ajoutee = false;

		if ($user) {
			$carnet_recette = new CarnetRecette;

			$recette_ajoutee = $carnet_recette->
				select('id_recette')->
				where('id_user', $user->id)->
				where('id_recette', $id_recette)->
				first();
		}

		return $recette_ajoutee ? true : false;
	}
}

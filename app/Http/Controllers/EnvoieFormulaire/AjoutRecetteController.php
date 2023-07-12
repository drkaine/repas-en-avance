<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjoutRecetteController extends Controller
{
	use AjoutEnDBTrait;
	use ValidationFormulaireTrait;

	public function ajoutRecette(Request $request): JsonResponse
	{
		$request->validate($this->recuperationDonneesAValider('ajout_recette'));

		$ustensiles = $request->ustensiles;

		if (! $request->filled('ustensiles')) {
			$ustensiles = [];
		}

		$mode_de_cuissons = $request->mode_de_cuissons;

		if (! $request->filled('mode_de_cuissons')) {
			$mode_de_cuissons = [];
		}

		$recette = $this->nouvelleRecette($request);

		$this->ustensile($ustensiles, $recette->id);

		$this->modeDeCuisson($mode_de_cuissons, $recette->id);

		$this->Ingredient($request->ingredients, $request->quantites, $recette->id);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

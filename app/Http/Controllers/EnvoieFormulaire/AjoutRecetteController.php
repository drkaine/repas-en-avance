<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjoutRecetteController extends Controller
{
	use AjoutEnDBTrait;

	public function ajoutRecette(Request $request): JsonResponse
	{
		$request->validate(config('validation_formulaire.ajoutRecette'));

		$ustensiles = $request->ustensiles;

		if (! $request->filled('ustensiles')) {
			$ustensiles = [];
		}

		$mode_de_cuissons = $request->mode_de_cuissons;

		if (! $request->filled('mode_de_cuissons')) {
			$mode_de_cuissons = [];
		}

		$recette = $this->nouvelleRecette($request);

		$this->tagsRecette($ustensiles, $recette->id);

		$this->tagsRecette($mode_de_cuissons, $recette->id);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

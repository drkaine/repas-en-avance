<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\VerificationDonneeRequestService;
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
		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$ustensiles = $verification_donnee_request->selectMutiple('ustensiles');

		$request->validate($this->recuperationDonneesAValider('ajout_recette'));

		$mode_de_cuissons = $verification_donnee_request->selectMutiple('mode_de_cuissons');

		$recette = $this->nouvelleRecette($request);

		$this->ustensile($ustensiles, $recette->id);

		$this->modeDeCuisson($mode_de_cuissons, $recette->id);

		$this->Ingredient($request->ingredients, $request->quantites, $recette->id);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

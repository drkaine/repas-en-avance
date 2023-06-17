<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireAjoutRecetteController extends Controller
{
	use AjoutEnDBTrait;

	public function ajoutRecette(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:255',
			'temps_preparation' => 'required|integer',
		]);

		$this->recette($request);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

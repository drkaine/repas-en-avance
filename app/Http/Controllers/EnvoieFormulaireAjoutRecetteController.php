<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireAjoutRecetteController extends Controller
{
	public function ajoutRecette(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:255',
			'temps_preparation' => 'required|integer',
		]);

		$ajout_en_db = new AjoutEnDBController($request);

		$ajout_en_db->recette();

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

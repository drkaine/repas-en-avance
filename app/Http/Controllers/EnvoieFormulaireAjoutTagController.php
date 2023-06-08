<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireAjoutTagController extends Controller
{
	public function ajoutTag(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:100',
		]);

		$ajout_en_db = new AjoutEnDBController($request);

		$ajout_en_db->tag();

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\AjoutEnDBController;
use App\Http\Controllers\Controller;
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

		$ajout_en_db->RelationTagsparent();

		$ajout_en_db->RelationTagsEnfant();

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

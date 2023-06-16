<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Taits\AjoutEnDBtrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireAjoutTagController extends Controller
{
    use AjoutEnDBtrait;

	public function ajoutTag(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:100',
		]);

		$id_tag = $this->tag($request);

		$this->RelationTagsparent($id_tag, $request);

		$this->RelationTagsEnfant($id_tag, $request);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjoutTagController extends Controller
{
	use AjoutEnDBTrait;

	public function ajoutTag(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:100',
		]);

		$id_tag = $this->nouveauTag($request);

		$this->relationTagsparent($id_tag, $request);

		$this->relationTagsEnfant($id_tag, $request);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

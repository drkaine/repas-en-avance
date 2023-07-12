<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjoutTagController extends Controller
{
	use AjoutEnDBTrait;
	use ValidationFormulaireTrait;

	public function ajoutTag(Request $request): JsonResponse
	{
		$request->validate($this->recuperationDonneesAValider('ajout_tag'));

		$id_tag = $this->nouveauTag($request);

		$this->relationTagsParent($id_tag, $request);

		$this->relationTagsEnfant($id_tag, $request);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

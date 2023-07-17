<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\VerificationDonneeRequestService;
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

		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$tags_parent = $verification_donnee_request->selectMutiple('tags_parent');

		$tags_enfant = $verification_donnee_request->selectMutiple('tags_enfant');

		$this->relationTagsParent($id_tag, $tags_parent);

		$this->relationTagsEnfant($id_tag, $tags_enfant);

		return response()->json(['message' => 'Tag ajouté'], 201);
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\VerificationDonneeRequestService;
use App\Traits\GestionDB\AjoutTrait;
use App\Traits\GestionDB\SelectTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AjoutTagController extends Controller
{
	use AjoutTrait;
	use SelectTrait;
	use ValidationFormulaireTrait;

	public function ajoutTag(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('ajout_tag'));

		$id_tag = $this->nouveauTag($request);

		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$tags_parent = $verification_donnee_request->selectMutiple('tags_parent');

		$tags_enfant = $verification_donnee_request->selectMutiple('tags_enfant');

		$this->relationTagsParent($id_tag, $tags_parent);

		$this->relationTagsEnfant($id_tag, $tags_enfant);

		$tags = $this->toutLesTags();

		$reponse_json = response()->json(['message' => 'Création réussie'], 201);
		$reponse_json = json_decode($reponse_json->getContent());

		return view('ajout_tag', compact('tags', 'reponse_json'));
	}
}

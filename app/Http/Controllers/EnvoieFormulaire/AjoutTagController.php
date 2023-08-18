<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\VerificationDonneeRequestService;
use App\Traits\AjoutEnDBTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AjoutTagController extends Controller
{
	use AjoutEnDBTrait;
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

		$tag = new Tag;

		$tags = $tag->select('id', 'nom')->get();

		$json = response()->json(['message' => 'Tag ajouté'], 201);

		return view('ajout_tag', compact('tags', 'json'));
	}
}

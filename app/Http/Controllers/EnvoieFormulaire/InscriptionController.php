<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Notifications\ConfirmationEmail;
use App\Services\RecuperationTagService;
use App\Services\VerificationDonneeRequestService;
use App\Traits\AjoutEnDBTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InscriptionController extends Controller
{
	use AjoutEnDBTrait;
	use ValidationFormulaireTrait;

	public function inscription(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('inscription'));

		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$user = $this->nouveauUser($request);

		$regimes_alimentaires = $verification_donnee_request->selectMutiple('regimes_alimentaires');

		$this->regimesAlimentaires($regimes_alimentaires, $user->id);

		// $user->notify(new ConfirmationEmail);

		$recuperation_tag = new RecuperationTagService;

		$id_tag_parent = $recuperation_tag->premierParNom('Régime alimentaire');

		$regimes_alimentaires = $id_tag_parent->recuperationTagEnfants;

		$reponse_json = response()->json(['message' => 'Inscription réussie'], 201);
		$reponse_json = json_decode($reponse_json->getContent());

		return view('inscription', compact('regimes_alimentaires', 'reponse_json'));
	}
}

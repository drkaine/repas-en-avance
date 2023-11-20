<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ConfirmationEmail;
use App\Services\GestionAffichageService;
use App\Services\VerificationDonneeRequestService;
use App\Traits\GestionDB\AjoutTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InscriptionController extends Controller
{
	use AjoutTrait;
	use ValidationFormulaireTrait;

	public function inscription(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('inscription'));

		$user = $this->creationDansLaDB($request);

		$user->notify(new ConfirmationEmail);

		$recuperation_tag = new GestionAffichageService;

		$regimes_alimentaires = $recuperation_tag->recuperationTagEnfants('Régime alimentaire');

		$reponse_json = response()->json(['message' => 'Inscription réussie'], 201);
		$reponse_json = json_decode($reponse_json->getContent());

		return view('inscription', compact('regimes_alimentaires', 'reponse_json'));
	}

	private function creationDansLaDB(Request $request): User
	{
		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$user = $this->nouveauUser($request);

		$regimes_alimentaires = $verification_donnee_request->selectMutiple('regimes_alimentaires');

		$this->regimesAlimentaires($regimes_alimentaires, $user->id);

		return $user;
	}
}

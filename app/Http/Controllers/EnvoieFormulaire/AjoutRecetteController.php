<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\GestionAffichageService;
use App\Services\VerificationDonneeRequestService;
use App\Traits\GestionDB\AjoutTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AjoutRecetteController extends Controller
{
	use AjoutTrait;
	use ValidationFormulaireTrait;

	public function ajoutRecette(Request $request): View
	{
		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$request->validate($this->recuperationDonneesAValider('ajout_recette'));

		$ustensiles = $verification_donnee_request->selectMutiple('ustensiles');

		$mode_de_cuissons = $verification_donnee_request->selectMutiple('mode_de_cuissons');

		$this->creationDansLaDB($request, $ustensiles, $mode_de_cuissons);

		$donnees_a_afficher = $this->recuperationDesDonnees();

		$mode_de_cuissons = $donnees_a_afficher['mode_de_cuissons'];

		$ustensiles = $donnees_a_afficher['ustensiles'];

		$ingredients = $donnees_a_afficher['ingredients'];

		$reponse_json = response()->json(['message' => 'Création réussie'], 201);
		$reponse_json = json_decode($reponse_json->getContent());

		return view('ajout_recette', compact('mode_de_cuissons', 'ustensiles', 'ingredients', 'reponse_json'));
	}

	private function creationDansLaDB(Request $request, array $ustensiles, array $mode_de_cuissons): void
	{
		$recette = $this->nouvelleRecette($request);

		$this->ustensile($ustensiles, $recette->id);

		$this->modeDeCuisson($mode_de_cuissons, $recette->id);

		$this->ingredient($request->ingredients, $request->quantitees, $recette->id);

		$request->file('photos')->move(public_path('storage/images'), $recette->url . '.jpeg');

		$this->nouvellePhoto($recette);
	}

	private function recuperationDesDonnees(): array
	{
		$recuperation_tag = new GestionAffichageService;

		$donnees_a_afficher['ustensiles'] = $recuperation_tag->recuperationTagEnfants('Ustensiles');

		$donnees_a_afficher['mode_de_cuissons'] = $recuperation_tag->recuperationTagEnfants('Mode de cuisson');

		$donnees_a_afficher['ingredients'] = $recuperation_tag->recuperationTagEnfants('Ingrédients');

		return $donnees_a_afficher;
	}
}

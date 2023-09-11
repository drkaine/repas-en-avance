<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\Recette;
use App\Services\RecuperationTagService;
use App\Services\VerificationDonneeRequestService;
use App\Traits\AjoutEnDBTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AjoutRecetteController extends Controller
{
	use AjoutEnDBTrait;
	use ValidationFormulaireTrait;

	public function ajoutRecette(Request $request): View
	{
		$verification_donnee_request = new VerificationDonneeRequestService($request);

		$ustensiles = $verification_donnee_request->selectMutiple('ustensiles');

		$request->validate($this->recuperationDonneesAValider('ajout_recette'));

		$mode_de_cuissons = $verification_donnee_request->selectMutiple('mode_de_cuissons');

		$recette = $this->nouvelleRecette($request);

		$this->ustensile($ustensiles, $recette->id);

		$this->modeDeCuisson($mode_de_cuissons, $recette->id);

		$this->ingredient($request->ingredients, $request->quantitees, $recette->id);

		$this->photo($request->photos, $recette->id);

		$recuperation_tag = new RecuperationTagService;

		$recette = new Recette;

		$recuperation_tag = new RecuperationTagService;

		$id_tag_ustensiles = $recuperation_tag->premierParNom('Ustensiles');

		$ustensiles = $id_tag_ustensiles->recuperationTagEnfants;

		$id_tag_mode_de_cuissons = $recuperation_tag->premierParNom('Mode de cuisson');

		$mode_de_cuissons = $id_tag_mode_de_cuissons->recuperationTagEnfants;

		$id_tag_ingredients = $recuperation_tag->premierParNom('Ingrédients');

		$ingredients = $id_tag_ingredients->recuperationTagEnfants;

		$reponse_json = response()->json(['message' => 'Création réussie'], 201);
		$reponse_json = json_decode($reponse_json->getContent());

		return view('ajout_recette', compact('mode_de_cuissons', 'ustensiles', 'ingredients', 'reponse_json'));
	}
}

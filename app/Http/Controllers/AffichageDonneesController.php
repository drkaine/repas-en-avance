<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\GestionAffichageService;
use App\Traits\GestionDB\SelectTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AffichageDonneesController extends Controller
{
	use SelectTrait;

	private Tag $tag;

	private GestionAffichageService $gestion_affichage;

	public function __construct()
	{
		$this->gestion_affichage = new GestionAffichageService;
	}

	public function pageAjoutTag(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$tags = $this->toutLesTags();

		return view('ajout_tag', compact('tags'));
	}

	public function affichageAjoutRecette(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$id_tag_ustensiles = $this->gestion_affichage->premierParNom('Ustensiles');

		$ustensiles = $id_tag_ustensiles->recuperationTagEnfants;

		$id_tag_mode_de_cuissons = $this->gestion_affichage->premierParNom('Mode de cuisson');

		$mode_de_cuissons = $id_tag_mode_de_cuissons->recuperationTagEnfants;

		$id_tag_ingredients = $this->gestion_affichage->premierParNom('Ingrédients');

		$ingredients = $id_tag_ingredients->recuperationTagEnfants;

		return view('ajout_recette', compact('mode_de_cuissons', 'ustensiles', 'ingredients'));
	}

	public function pageMonCompte(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$id_tag_parent = $this->gestion_affichage->premierParNom('Régime alimentaire');

		$tags_regimes_alimentaires = $id_tag_parent->recuperationTagEnfants;

		$recuperationTags = $user->recuperationTags;

		$regimes_alimentaires = [];

		foreach ($recuperationTags as $tag) {
			$regimes_alimentaires[] = $tag->id;
		}

		return view('mon_compte', compact('user', 'tags_regimes_alimentaires', 'regimes_alimentaires'));
	}

	public function pageInscription(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if ($user) {
			return redirect('mon-compte');
		}

		$id_tag_parent = $this->gestion_affichage->premierParNom('Régime alimentaire');

		$regimes_alimentaires = $id_tag_parent->recuperationTagEnfants;

		return view('inscription', compact('regimes_alimentaires'));
	}

	public function pageCatalogueRecettes(): View
	{
		$recettes = $this->toutesLesRecettes();

		$recette_ajoutee = $this->recuperationRecettesAjoutees($recettes);

		return view('catalogue_recettes', compact('recettes', 'recette_ajoutee'));
	}

	public function pageAccueil(): View
	{
		$recettes = $this->toutesLesRecettes('created_at');

		$recette_ajoutee = $this->recuperationRecettesAjoutees($recettes);

		return view('accueil', compact('recettes', 'recette_ajoutee'));
	}

	public function carnetRecettes(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('connexion');
		}

		$carnet_recettes = $this->carnetRecettesParUser($user);

		$id_recettes = [];

		foreach ($carnet_recettes as $recette) {
			$id_recettes[] = $recette->id;
		}

		$recettes = $this->toutesLesRecettesParListIdRecette($id_recettes);

		$recette_ajoutee = $this->recuperationRecettesAjoutees($recettes);

		return view('carnet_recettes', compact('recettes', 'recette_ajoutee'));
	}

	private function recuperationRecettesAjoutees(Collection $recettes): array
	{
		$id_recettes = [];

		foreach ($recettes as $recette) {
			$id_recettes[] = $recette->id;
		}

		$recettes_ajoutees = $this->gestion_affichage->recetteAjoutee($id_recettes);

		return $recettes_ajoutees;
	}
}

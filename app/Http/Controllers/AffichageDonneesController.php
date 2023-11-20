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

		$ustensiles = $this->gestion_affichage->recuperationTagEnfants('Ustensiles');

		$mode_de_cuissons = $this->gestion_affichage->recuperationTagEnfants('Mode de cuisson');

		$ingredients = $this->gestion_affichage->recuperationTagEnfants('Ingrédients');

		return view('ajout_recette', compact('mode_de_cuissons', 'ustensiles', 'ingredients'));
	}

	public function pageMonCompte(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$tags_regimes_alimentaires = $this->gestion_affichage->recuperationTagEnfants('Régime alimentaire');

		$regimes_alimentaires = $this->recuperationIdTags($user->recuperationTags);

		return view('mon_compte', compact('user', 'tags_regimes_alimentaires', 'regimes_alimentaires'));
	}

	public function pageInscription(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if ($user) {
			return redirect('mon-compte');
		}

		$regimes_alimentaires = $this->gestion_affichage->recuperationTagEnfants('Régime alimentaire');

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

		$id_recettes = $this->recuperationIdRecettes($carnet_recettes);

		$recettes = $this->toutesLesRecettesParListIdRecette($id_recettes);

		$recette_ajoutee = $this->recuperationRecettesAjoutees($recettes);

		return view('carnet_recettes', compact('recettes', 'recette_ajoutee'));
	}

	private function recuperationIdRecettes(Collection $carnet_recettes): array
	{
		$id_recettes = [];

		foreach ($carnet_recettes as $recette) {
			$id_recettes[] = $recette->id;
		}

		return $id_recettes;
	}

	private function recuperationIdTags(Collection $recuperationTags): array
	{
		$regimes_alimentaires = [];

		foreach ($recuperationTags as $tag) {
			$regimes_alimentaires[] = $tag->id;
		}

		return $regimes_alimentaires;
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

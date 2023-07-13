<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Tag;
use App\Services\RecuperationTagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AffichageDonneesController extends Controller
{
	private Tag $tag;

	private Recette $recette;

	private RecuperationTagService $recuperation_tag;

	public function __construct()
	{
		$this->tag = new Tag;

		$this->recuperation_tag = new RecuperationTagService;

		$this->recette = new Recette;
	}

	public function pageAjoutTag(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$tags = $this->tag->select('id', 'nom')->get();

		return view('ajout_tag', compact('tags'));
	}

	public function affichageAjoutRecette(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$id_tag_ustensiles = $this->recuperation_tag->premierParNom('Ustensiles');

		$ustensiles = $id_tag_ustensiles->recuperationTagEnfants;

		$id_tag_mode_de_cuissons = $this->recuperation_tag->premierParNom('Mode de cuisson');

		$mode_de_cuissons = $id_tag_mode_de_cuissons->recuperationTagEnfants;

		$id_tag_ingredients = $this->recuperation_tag->premierParNom('Ingrédients');

		$ingredients = $id_tag_ingredients->recuperationTagEnfants;

		return view('ajout_recette', compact('mode_de_cuissons', 'ustensiles', 'ingredients'));
	}

	public function pageMonCompte(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$id_tag_parent = $this->recuperation_tag->premierParNom('Régime alimentaire');

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
			return redirect('mon_compte');
		}

		$id_tag_parent = $this->recuperation_tag->premierParNom('Régime alimentaire');

		$regimes_alimentaires = $id_tag_parent->recuperationTagEnfants;

		return view('inscription', compact('regimes_alimentaires'));
	}

	public function pageCatalogueRecettes(): View
	{
		$recettes = $this->recette->with('recuperationIngredient')->get();

		return view('catalogue_recettes', compact('recettes'));
	}
}

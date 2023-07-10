<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AffichageDonneesController extends Controller
{
	private Tag $tag;

	private Recette $recette;

	public function __construct()
	{
		$this->tag = new Tag;

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

		$id_tag_ustensiles = $this->tag->select('id')->
			where('nom', 'Ustensiles')->
			first();

		$ustensiles = $id_tag_ustensiles->recuperationTagEnfants;

		$id_tag_mode_de_cuissons = $this->tag->select('id')->
			where('nom', 'Mode de cuisson')->
			first();

		$mode_de_cuissons = $id_tag_mode_de_cuissons->recuperationTagEnfants;

		$id_tag_ingredients = $this->tag->select('id')->
			where('nom', 'Ingrédients')->
			first();

		$ingredients = $id_tag_ingredients->recuperationTagEnfants;

		return view('ajout_recette', compact('mode_de_cuissons', 'ustensiles', 'ingredients'));
	}

	public function pageMonCompte(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$id_tag_parent = $this->tag->select('id')->
			where('nom', 'Régime alimentaire')->
			first();

		$regimes_alimentaires = $id_tag_parent->recuperationTagEnfants;

		$tags_user = $user->recuperationTags;

		return view('mon_compte', compact('user', 'regimes_alimentaires', 'tags_user'));
	}

	public function pageInscription(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if ($user) {
			return redirect('mon_compte');
		}

		$id_tag_parent = $this->tag->select('id')->
			where('nom', 'Régime alimentaire')->
			first();

		$regimes_alimentaires = $id_tag_parent->recuperationTagEnfants;

		return view('inscription', compact('regimes_alimentaires'));
	}

	public function pageCatalogueRecettes(): View
	{
		$recettes = $this->recette->get();

		return view('catalogue_recettes', compact('recettes'));
	}
}

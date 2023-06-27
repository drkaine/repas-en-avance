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

	public function pageRecettes(): View
	{
		$recettes = $this->recette->get();

		return view('recettes', compact('recettes'));
	}
}

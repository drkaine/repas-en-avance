<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AffichageDonneeDesVueController extends Controller
{
	private Tag $tag;

	public function __construct()
	{
		$this->tag = new Tag;
	}

	public function ajoutTag(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$tags = $this->tag->select('id', 'nom')->get();

		return view('ajout_tag', compact('tags'));
	}

	public function user(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		return view('mon_compte', compact('user'));
	}

	public function inscription(): View
	{
		$id_tag_parent = $this->tag->select('id')->
			where('nom', 'Régime alimentaire')->
			first();

		$regimes_alimentaires = $id_tag_parent->tagEnfants;

		return view('inscription', compact('regimes_alimentaires'));
	}
}

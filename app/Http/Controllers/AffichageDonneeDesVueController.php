<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AffichageDonneeDesVueController extends Controller
{
	public function ajoutTag(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		$tags = new Tag;
		$tags = $tags->select('id', 'nom')->get();

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
}

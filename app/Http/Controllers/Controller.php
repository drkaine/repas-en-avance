<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class Controller extends BaseController
{
	use AuthorizesRequests;
	use ValidatesRequests;

	public function affichageAjoutRecette(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if (! $user) {
			return redirect('inscription');
		}

		return view('ajout_recette');
	}

	public function affichageConnexion(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if ($user) {
			return redirect('mon_compte');
		}

		return view('connexion');
	}
}

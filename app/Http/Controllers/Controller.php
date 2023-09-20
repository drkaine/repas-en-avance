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

	public function affichageConnexion(): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if ($user) {
			return redirect('mon-compte');
		}

		return view('connexion');
	}

	public function affichageMotDePasseOublie(string $identifiant_user): View | RedirectResponse | Redirector
	{
		$user = auth()->user();

		if ($user) {
			return redirect('mon-compte');
		}
		$identifiant = 'demande' === $identifiant_user;

		return view('mot_de_passe_oublie', compact('identifiant'));
	}
}

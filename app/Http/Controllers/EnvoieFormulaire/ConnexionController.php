<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\ModificationUserService;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
	use ValidationFormulaireTrait;

	public function connexion(Request $request): RedirectResponse | Redirector
	{
		$user = $request->validate($this->recuperationDonneesAValider('connexion'));

		Auth::attempt($user);

		$user_authentifie = auth()->user();

		$modification_user = new ModificationUserService($user_authentifie);

		$modification_user->derniereConnexion();

		$modification_user->sauvegarde();

		return redirect('/');
	}
}

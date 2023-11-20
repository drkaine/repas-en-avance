<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ModificationUserService;
use App\Traits\ValidationFormulaireTrait;
use Carbon\Carbon;
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

		if (!isset($user_authentifie->email_verified_at)) {
			Auth::logout();

			return redirect('inscription');
		}

		$this->modificationDonneesUser($user_authentifie);

		return redirect('/');
	}

	private function modificationDonneesUser(User $user_authentifie): void
	{
		$modification_user = new ModificationUserService($user_authentifie);

		$date = new Carbon;

		$modification_user->modificationChamp('derniere_connexion', $date->now());

		$modification_user->sauvegarde();
	}
}

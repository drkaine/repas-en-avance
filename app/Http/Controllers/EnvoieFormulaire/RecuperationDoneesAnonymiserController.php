<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ModificationUserService;
use App\Traits\GestionDB\SelectTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RecuperationDoneesAnonymiserController extends Controller
{
	use ValidationFormulaireTrait;
	use SelectTrait;

	public function monCompte(Request $request): RedirectResponse | Redirector
	{
		$request->validate($this->recuperationDonneesAValider('recuperation_compte'));

		$user_recupere = $this->userParEmail($request->email_anonyme);

		if (!password_verify($request->password, $user_recupere->password)) {
			return view('recuperation_compte');
		}

		$this->modificationUser($request, $user_recupere);

		return redirect('/');
	}

	private function modificationUser(Request $request, User $user_recupere): void
	{
		$modification_user = new ModificationUserService($user_recupere);

		$modification_user->modificationChamp('nom', $request->nom);

		$modification_user->modificationChamp('prenom', $request->prenom);

		$modification_user->modificationChamp('email', $request->email);

		$modification_user->sauvegarde();
	}
}

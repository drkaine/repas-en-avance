<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\ModificationUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AnonymisationDeDonneesController extends Controller
{
	public function compteUser(): RedirectResponse | Redirector
	{
		$user = auth()->user();

		$modification_user = new ModificationUserService($user);

		$modification_user->nom('Anonyme');

		$modification_user->email('anonyme' . $user->id . '@anonyme.fr');

		$modification_user->emailVerifiedAt(null);

		$modification_user->sauvegarde();

		return redirect('deconnexion');
	}
}

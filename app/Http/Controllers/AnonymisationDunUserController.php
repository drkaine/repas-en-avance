<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AnonymisationDunUserController extends Controller
{
	public function anonymisationDuCompte(): RedirectResponse | Redirector
	{
		$user = auth()->user();

		$user->nom = 'Anonyme';
		$user->email = 'anonyme' . $user->id . '@anonyme.fr';
		$user->email_verified_at = null;

		$user->save();

		return redirect('deconnexion');
	}
}

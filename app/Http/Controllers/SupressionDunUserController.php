<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SupressionDunUserController extends Controller
{
	public function anonymisation_du_compte(): RedirectResponse | Redirector
	{
		$user = auth()->user();

		$user->nom = 'Anonyme';
		$user->email = 'anonyme' . $user->id . '@anonyme.fr';
		$user->derniere_connexion = null;
		$user->password = bcrypt('anonyme');
		$user->email_verified_at = null;

		$user->save();

		return redirect('/');
	}
}

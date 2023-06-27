<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RecuperationDoneesAnonymiserController extends Controller
{
	public function monCompte(Request $request): RedirectResponse | Redirector
	{
		$user = new User;

		$user_recupere = $user->where('email', $request->email_anonyme)->
			first();

		if (password_verify($request->password, $user_recupere->password)) {
			$user_recupere->nom = $request->nom;
			$user_recupere->email = $request->email;

			$user_recupere->save();
		}

		return redirect('/');
	}
}

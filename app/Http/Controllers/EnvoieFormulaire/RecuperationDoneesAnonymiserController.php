<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ModificationUserService;
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
			$modification_user = new ModificationUserService($user_recupere);

			$modification_user->nom($request->nom);

			$modification_user->email($request->email);

			$modification_user->sauvegarde();
		}

		return redirect('/');
	}
}

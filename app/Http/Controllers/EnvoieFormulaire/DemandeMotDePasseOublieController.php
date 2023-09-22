<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\MotDePasseOublieEmail;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemandeMotDePasseOublieController extends Controller
{
	use ValidationFormulaireTrait;

	public function validationFormulaire(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('demande_mot_de_passe_oublie'));

		$user = new User;

		$user = $user->select()->
			where('email', $request->email)->
			first();

		$user->notify(new MotDePasseOublieEmail);

		return view('connexion');
	}
}

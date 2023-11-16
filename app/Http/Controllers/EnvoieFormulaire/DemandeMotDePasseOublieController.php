<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Notifications\MotDePasseOublieEmail;
use App\Traits\GestionDB\SelectTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemandeMotDePasseOublieController extends Controller
{
	use ValidationFormulaireTrait;
	use SelectTrait;

	public function validationFormulaire(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('demande_mot_de_passe_oublie'));

		$user = $this->userParEmail($request->email);

		$user->notify(new MotDePasseOublieEmail);

		return view('connexion');
	}
}

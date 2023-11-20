<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\ModificationUserService;
use App\Traits\GestionDB\SelectTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MotDePasseOublieController extends Controller
{
	use ValidationFormulaireTrait;
	use SelectTrait;

	public function validationFormulaire(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('mot_de_passe_oublie'));

		$this->modificationUser($request);

		return view('connexion');
	}

	private function modificationUser(Request $request): void
	{
		$user = $this->userParEmail($request->email);

		$modification_user = new ModificationUserService($user);

		$modification_user->modificationChamp('password', bcrypt($request->password));

		$modification_user->sauvegarde();
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MotDePasseOublieController extends Controller
{
	use ValidationFormulaireTrait;

	public function validationFormulaire(Request $request): View
	{
		$request->validate($this->recuperationDonneesAValider('mot_de_passe_oublie'));

		return view('connexion');
	}
}

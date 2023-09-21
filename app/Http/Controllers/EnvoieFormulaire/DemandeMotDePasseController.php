<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemandeMotDePasseController extends Controller
{
	public function validationFormulaire(Request $request): View
	{

		return view('connexion');
	}
}

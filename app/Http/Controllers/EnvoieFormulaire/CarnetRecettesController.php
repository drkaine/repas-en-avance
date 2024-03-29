<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\GestionDB\AjoutTrait;
use App\Traits\GestionDB\SuppressionTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CarnetRecettesController extends Controller
{
	use AjoutTrait;
	use SuppressionTrait;

	public function ajout(Request $request): RedirectResponse | Redirector
	{
		$this->nouveauCarnetRecettes((int) $request->id_user, (int) $request->id_recette);

		return redirect('/');
	}

	public function suppression(Request $request): RedirectResponse | Redirector
	{
		$this->carnetRecetteParIdUserEtIdRecette($request->id_recette, $request->id_user);

		return redirect('/');
	}
}

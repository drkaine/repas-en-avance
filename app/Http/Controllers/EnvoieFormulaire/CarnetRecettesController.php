<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\CarnetRecette;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CarnetRecettesController extends Controller
{
	use AjoutEnDBTrait;

	public function ajout(Request $request): RedirectResponse | Redirector
	{
		$this->nouveauCarnetRecettes((int) $request->id_user, (int) $request->id_recette);

		return redirect('/');
	}

	public function suppression(Request $request): RedirectResponse | Redirector
	{
		$carnet_recettes = new CarnetRecette;

		$carnet_recettes = $carnet_recettes->
			where('id_recette', $request->id_recette)->
			where('id_user', $request->id_user)->
			delete();

		return redirect('/');
	}
}

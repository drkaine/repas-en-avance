<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Models\CarnetRecette;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\Request;

class CarnetRecettesController extends Controller
{
	use AjoutEnDBTrait;

	public function ajout(Request $request): void
	{
		$this->nouveauCarnetRecettes($request->id_user, $request->id_recette);
	}

	public function suppression(Request $request): void
	{
		$carnet_recettes = new CarnetRecette;

		$carnet_recettes = $carnet_recettes->
			where('id_recette', $request->id_recette)->
			where('id_user', $request->id_user)->
			delete();
	}
}

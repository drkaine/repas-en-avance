<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\Request;

class CarnetRecettesController extends Controller
{
	use AjoutEnDBTrait;

	public function ajout(Request $request): void
	{
		$this->nouveauCarnetRecettes($request->id_user, $request->id_recette);
	}
}

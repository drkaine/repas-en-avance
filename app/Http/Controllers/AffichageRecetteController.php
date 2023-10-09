<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AffichageRecetteController extends Controller
{
	private Recette $recette;

	public function __construct()
	{
		$this->recette = new Recette;
	}

	public function Recette(): View
	{
		$nom_recette = Route::current()->parameter('nom_recette');

		$recette = $this->recette->
			with('recuperationIngredient')->
			with('recuperationPhoto')->
			where('url', $nom_recette)->
			first();

		return view('recette', compact('recette'));
	}
}

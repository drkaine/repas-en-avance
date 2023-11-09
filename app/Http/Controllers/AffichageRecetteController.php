<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Services\GestionAffichageService;
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

		$gestion_affichage = new GestionAffichageService;

		$recette_ajoutee = $gestion_affichage->recetteAjoutee($recette->id);

		return view('recette', compact('recette', 'recette_ajoutee'));
	}
}

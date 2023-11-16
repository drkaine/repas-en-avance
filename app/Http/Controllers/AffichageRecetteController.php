<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Services\GestionAffichageService;
use App\Traits\GestionDB\SelectTrait;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AffichageRecetteController extends Controller
{
	use SelectTrait;

	private Recette $recette;

	public function __construct()
	{
		$this->recette = new Recette;
	}

	public function Recette(): View
	{
		$nom_recette = Route::current()->parameter('nom_recette');

		$recette = $this->recetteParUrl($nom_recette);

		$gestion_affichage = new GestionAffichageService;

		$recette_ajoutee = $gestion_affichage->recetteAjoutee([$recette->id]);

		return view('recette', compact('recette', 'recette_ajoutee'));
	}
}

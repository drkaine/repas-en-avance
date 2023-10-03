<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Tag;
use App\Services\RecuperationTagService;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AffichageRecetteController extends Controller
{
	private Tag $tag;

	private Recette $recette;

	private RecuperationTagService $recuperation_tag;

	public function __construct()
	{
		$this->tag = new Tag;

		$this->recuperation_tag = new RecuperationTagService;

		$this->recette = new Recette;
	}

	public function Recette(): View
	{
		$nom_recette = Route::current()->parameter('nom_recette');

		$recette = $this->recette->
			with('recuperationIngredient')->
			where('url', $nom_recette)->
			first();

		return view('recette', compact('recette'));
	}
}

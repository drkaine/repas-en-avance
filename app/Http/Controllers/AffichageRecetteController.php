<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Tag;
use App\Services\RecuperationTagService;
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

		return view('recette');
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class AffichageDonneeDeLaVueController extends Controller
{
	public function ajoutTag(): View
	{
		$tags = new Tag;
		$tags = $tags->select('nom')->get();

		return view('ajout_tag', compact('tags'));
	}
}

<?php

declare(strict_types = 1);

namespace App\Services;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class GestionRedirectionService
{
	public function userConnecte(string $nom_redirection, string $nom_view): View | RedirectResponse | Redirector
	{
		if (auth()->user()) {
			return redirect($nom_redirection);
		}

		return view($nom_view);
	}
}

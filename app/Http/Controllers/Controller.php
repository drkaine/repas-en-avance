<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\GestionRedirectionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class Controller extends BaseController
{
	use AuthorizesRequests;
	use ValidatesRequests;

	private GestionRedirectionService $gestion_redirection;

	public function __construct()
	{
		$this->gestion_redirection = new GestionRedirectionService;
	}

	public function affichageConnexion(): View | RedirectResponse | Redirector
	{
		$page = $this->gestion_redirection->userConnecte('mon-compte', 'connexion');

		return $page;
	}

	public function affichageMotDePasseOublie(): View | RedirectResponse | Redirector
	{
		$page = $this->gestion_redirection->userConnecte('mon-compte', 'mot_de_passe_oublie');

		return $page;
	}

	public function affichageDemandeMotDePasseOublie(): View | RedirectResponse | Redirector
	{
		$page = $this->gestion_redirection->userConnecte('mon-compte', 'demande_mot_de_passe_oublie');

		return $page;
	}
}

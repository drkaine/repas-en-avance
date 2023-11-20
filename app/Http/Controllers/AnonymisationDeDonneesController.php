<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\RecuperationCompteEmail;
use App\Services\ModificationUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AnonymisationDeDonneesController extends Controller
{
	public function compteUser(): RedirectResponse | Redirector
	{
		$user = auth()->user();

		$this->modificationUser($user);

		$user->notify(new RecuperationCompteEmail);

		return redirect('deconnexion');
	}

	private function modificationUser(User $user): void
	{
		$modification_user = new ModificationUserService($user);

		$modification_user->modificationChamp('nom', 'Anonyme');

		$modification_user->modificationChamp('email', 'anonyme' . $user->id . '@anonyme.fr');

		$modification_user->modificationChamp('email_verified_at', null);

		$modification_user->sauvegarde();
	}
}

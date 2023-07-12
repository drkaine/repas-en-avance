<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\RegimeAlimentaire;
use App\Services\ModificationUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ModificationDeDonneesController extends Controller
{
	public function monCompte(Request $request): RedirectResponse | Redirector
	{
		$user = auth()->user();

		$modification_user = new ModificationUserService($user);

		$modification_user->nom($request->nom);

		$modification_user->email($request->email);

		$modification_user->sauvegarde();

		$regime_alimentaire = new RegimeAlimentaire;

		$regime_alimentaire->where('id_user', $user->id)->
			delete();

		foreach ($request->regimes_alimentaires as $id_tag) {
			$regime_alimentaire->create([
				'id_user' => $user->id,
				'id_tag' => $id_tag,
			]);
		}

		return redirect('/');
	}
}

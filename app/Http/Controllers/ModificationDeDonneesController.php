<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\TagUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ModificationDeDonneesController extends Controller
{
	public function monCompte(Request $request): RedirectResponse | Redirector
	{
		$user = auth()->user();

		$user->nom = $request->nom;
		$user->email = $request->email;

		$user->save();

		$tags_user = new TagUser;

		$tags_user->where('id_user', $user->id)->
			delete();

		foreach ($request->regimes_alimentaires as $id_tag) {
			$tags_user->create([
				'id_user' => $user->id,
				'id_tag' => $id_tag,
			]);
		}

		return redirect('/');
	}
}

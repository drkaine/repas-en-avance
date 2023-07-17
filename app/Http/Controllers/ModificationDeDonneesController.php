<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\RegimeAlimentaire;
use App\Services\ModificationUserService;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModificationDeDonneesController extends Controller
{
	use AjoutEnDBTrait;

	public function monCompte(Request $request): JsonResponse
	{
		$user = auth()->user();

		$modification_user = new ModificationUserService($user);

		$modification_user->nom($request->nom);

		$modification_user->email($request->email);

		$modification_user->sauvegarde();

		$regime_alimentaire = new RegimeAlimentaire;

		$regime_alimentaire->where('id_user', $user->id)->
			delete();

		$this->regimesAlimentaires($request->tags_regimes_alimentaires, $user->id);

		return response()->json(['message' => 'modification réussie'], 201);
	}
}

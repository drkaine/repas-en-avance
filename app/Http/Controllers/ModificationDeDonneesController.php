<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\ModificationUserService;
use App\Traits\AjoutEnDBTrait;
use App\Traits\SuppressionEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModificationDeDonneesController extends Controller
{
	use AjoutEnDBTrait;
	use SuppressionEnDBTrait;

	public function monCompte(Request $request): JsonResponse
	{
		$user = auth()->user();

		$modification_user = new ModificationUserService($user);

		$modification_user->modificationChamp('nom', $request->nom);

		$modification_user->modificationChamp('email', $request->email);

		$modification_user->sauvegarde();

		$this->regimeAlimentaireParIdUser($user->id);

		$this->regimesAlimentaires($request->tags_regimes_alimentaires, $user->id);

		return response()->json(['message' => 'modification réussie'], 201);
	}
}

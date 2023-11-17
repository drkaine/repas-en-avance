<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ModificationUserService;
use App\Traits\GestionDB\AjoutTrait;
use App\Traits\GestionDB\SuppressionTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModificationDeDonneesController extends Controller
{
	use AjoutTrait;
	use SuppressionTrait;

	public function monCompte(Request $request): JsonResponse
	{
		$user = auth()->user();

		$this->modificationUser($user, $request);

		$this->suppressionRegimesAlimentaires($user->id, $request->tags_regimes_alimentaires);

		return response()->json(['message' => 'modification réussie'], 201);
	}

	private function modificationUser(User $user, Request $request): void
	{
		$modification_user = new ModificationUserService($user);

		$modification_user->modificationChamp('nom', $request->nom);

		$modification_user->modificationChamp('email', $request->email);

		$modification_user->sauvegarde();
	}

	private function suppressionRegimesAlimentaires(int $id_user, array $tags_regimes_alimentaires): void
	{
		$this->regimeAlimentaireParIdUser($id_user);

		$this->regimesAlimentaires($tags_regimes_alimentaires, $id_user);
	}
}

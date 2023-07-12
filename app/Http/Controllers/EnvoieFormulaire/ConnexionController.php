<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Services\ModificationUserService;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
	use ValidationFormulaireTrait;

	public function connexion(Request $request): JsonResponse
	{
		$user = $request->validate($this->recuperationDonneesAValider('connexion'));

		Auth::attempt($user);

		$user_authentifie = auth()->user();

		$modification_user = new ModificationUserService($user_authentifie);

		$modification_user->derniereConnexion();

		$modification_user->sauvegarde();

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
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

		$user_authentifie->derniere_connexion = date('Y-m-d');
		$user_authentifie->save();

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

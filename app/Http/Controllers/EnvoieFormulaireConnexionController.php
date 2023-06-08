<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnvoieFormulaireConnexionController extends Controller
{
	public function connexion(Request $request): JsonResponse
	{
		$user = $request->validate([
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|min:8',
		]);

		Auth::attempt($user);

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

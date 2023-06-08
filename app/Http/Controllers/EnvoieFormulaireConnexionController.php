<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireConnexionController extends Controller
{
	public function connexion(Request $request): JsonResponse
	{
		$request->validate([
			'email' => 'required|string|email',
		]);

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireController extends Controller
{
	public function inscription(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:255',
			'email' => 'required|string|email|unique:users|max:255',
			'password' => 'required|string|min:8',
		]);

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

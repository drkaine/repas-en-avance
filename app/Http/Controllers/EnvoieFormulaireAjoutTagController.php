<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireAjoutTagController extends Controller
{
	public function ajoutTag(Request $request): JsonResponse
	{
		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

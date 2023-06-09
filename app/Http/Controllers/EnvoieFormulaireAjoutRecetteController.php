<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireAjoutRecetteController extends Controller
{
	public function ajoutRecette(Request $request): JsonResponse
	{

		return response()->json(['message' => 'connexion réussie'], 201);
	}
}

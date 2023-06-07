<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireController extends Controller
{
	public function inscription(Request $request): JsonResponse
	{
		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

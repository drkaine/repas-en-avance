<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Taits\AjoutEnDBtrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireInscriptionController extends Controller
{
    use AjoutEnDBtrait;

	public function inscription(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:100',
			'email' => 'required|string|email|unique:users|max:255',
			'password' => 'required|string|min:8|confirmed',
		]);

		$this->user($request);

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

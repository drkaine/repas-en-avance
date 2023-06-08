<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireInscriptionController extends Controller
{
	public function inscription(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:100',
			'email' => 'required|string|email|unique:users|max:255',
			'password' => 'required|string|min:8|confirmed',
		]);

		$ajout_en_db = new AjoutEnDBController($request);

		$ajout_en_db->user();

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

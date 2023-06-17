<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnvoieFormulaireInscriptionController extends Controller
{
	use AjoutEnDBTrait;

	public function inscription(Request $request): JsonResponse
	{
		$request->validate([
			'nom' => 'required|string|max:100',
			'email' => 'required|string|email|unique:users|max:255',
			'password' => 'required|string|min:8|confirmed',
		]);

		$user = $this->user($request);

		$this->tagsUser($request, $user->id);

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

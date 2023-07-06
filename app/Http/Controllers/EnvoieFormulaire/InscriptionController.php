<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Notifications\ConfirmationEmail;
use App\Traits\AjoutEnDBTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
	use AjoutEnDBTrait;

	public function inscription(Request $request): JsonResponse
	{
		$request->validate(config('validation_formulaire.inscription'));

		$user = $this->nouveauUser($request);

		$regimes_alimentaires = $request->regimes_alimentaires;

		if (! $request->filled('regimes_alimentaires')) {
			$regimes_alimentaires = [];
		}

		$this->tagsUser($regimes_alimentaires, $user->id);

		$user->notify(new ConfirmationEmail);

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

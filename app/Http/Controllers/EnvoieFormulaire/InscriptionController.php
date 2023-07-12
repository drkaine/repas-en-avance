<?php

declare(strict_types = 1);

namespace App\Http\Controllers\EnvoieFormulaire;

use App\Http\Controllers\Controller;
use App\Notifications\ConfirmationEmail;
use App\Traits\AjoutEnDBTrait;
use App\Traits\ValidationFormulaireTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
	use AjoutEnDBTrait;
	use ValidationFormulaireTrait;

	public function inscription(Request $request): JsonResponse
	{
		$request->validate($this->recuperationDonneesAValider('inscription'));

		$user = $this->nouveauUser($request);

		$regimes_alimentaires = $request->regimes_alimentaires;

		if (! $request->filled('regimes_alimentaires')) {
			$regimes_alimentaires = [];
		}

		$this->regimesAlimentaires($regimes_alimentaires, $user->id);

		$user->notify(new ConfirmationEmail);

		return response()->json(['message' => 'Inscription réussie'], 201);
	}
}

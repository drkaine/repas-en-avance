<?php

declare(strict_types = 1);

namespace App\Services;

use Illuminate\Http\Request;

class VerificationDonneeRequestService
{
	public function __construct(private Request $request)
	{
	}

	public function selectMutiple(string $champs): array
	{
		return $this->request->filled($champs) ? $this->request->{$champs} : [];
	}
}

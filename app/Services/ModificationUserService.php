<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\User;

class ModificationUserService
{
	public function __construct(private User $user)
	{
	}

	public function modificationChamp(string $nom_du_champ, mixed $valeur_du_champ): void
	{
		$this->user->{$nom_du_champ} = $valeur_du_champ;
	}

	public function sauvegarde(): void
	{
		$this->user->save();
	}
}

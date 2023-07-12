<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class ModificationUserService
{
	public function __construct(private User $user)
	{
	}

	public function derniereConnexion(): void
	{
		$date = new Carbon;
		$this->user->derniere_connexion = $date->now();
	}

	public function nom(string $nom): void
	{
		$this->user->nom = $nom;

	}

	public function email(string $email): void
	{
		$this->user->email = $email;
	}

	public function emailVerifiedAt(?Carbon $date): void
	{
		$this->user->email_verified_at = $date;
	}

	public function sauvegarde(): void
	{
		$this->user->save();
	}
}

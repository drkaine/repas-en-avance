<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use App\Traits\GestionDB\ModificationTrait;
use App\Traits\GestionDB\SuppressionTrait;
use Carbon\Carbon;

class GestionUsersInactifService
{
	use SuppressionTrait;
	use ModificationTrait;

	public function anonymiser(): void
	{
		$date = new Carbon;

		$this->userEnAnonyme($date->now()->subMonths(3));
	}

	public function supprimer(): void
	{
		$date = new Carbon;

		$users = new User;

		$id_users_anonymes = $users->whereDate('derniere_connexion', '<', $date->now()->subMonths(6))->
			pluck('id');

		$this->userParListIdUser($id_users_anonymes);

		$this->regimeAlimentaireParListIdUser($id_users_anonymes);
	}
}

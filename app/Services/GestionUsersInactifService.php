<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use App\Traits\SuppressionEnDBTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GestionUsersInactifService
{
	use SuppressionEnDBTrait;

	public function anonymiser(): void
	{
		$date = new Carbon;

		$users = new User;

		$users->whereDate('derniere_connexion', '<', $date->now()->subMonths(3))->
			update([
				'nom' => 'Anonyme',
				'email' => DB::raw('\'anonyme\' || id || \'@anonyme.fr\''),
				'email_verified_at' => null,
			]);
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

<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\RegimeAlimentaire;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GestionUsersInactifServices
{
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

		$regimes_alimentaires = new RegimeAlimentaire;

		$id_users_anonymes = $users->whereDate('derniere_connexion', '<', $date->now()->subMonths(6))->
			pluck('id');

		$users->whereIn('id', $id_users_anonymes)->
			delete();

		$regimes_alimentaires->whereIn('id_user', $id_users_anonymes)->
			delete();
	}
}

<?php

declare(strict_types = 1);

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GestionUsersInactifHelper
{
	public function anonymiser(): void
	{
		$date = new Carbon;

		$users = new User;

		$users->whereDate('derniere_connexion', '<', $date->now()->subMonths(3))->
			update([
				'nom' => 'Anonyme',
				'email' => DB::raw('\'anonyme\' || id || \'@anonyme.fr\''),
				'derniere_connexion' => null,
				'password' => bcrypt('anonyme'),
				'email_verified_at' => null,
			]);
	}
}

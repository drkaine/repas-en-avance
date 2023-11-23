<?php

declare(strict_types = 1);

namespace App\Traits\GestionDB;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait ModificationTrait
{
	public function userEnAnonyme(Carbon $date): void
	{
		$users = new User;

		$users->whereDate('derniere_connexion', '<', $date)->
			update([
				'nom' => 'Anonyme',
				'prenom' => 'Anonyme',
				'email' => DB::raw('\'anonyme\' || id || \'@anonyme.fr\''),
				'email_verified_at' => null,
			]);
	}
}

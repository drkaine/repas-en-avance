<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait UpdateEnDBTrait
{
	public function userEnAnonyme(Carbon $date): void
	{
		$users = new User;

		$users->whereDate('derniere_connexion', '<', $date)->
			update([
				'nom' => 'Anonyme',
				'email' => DB::raw('\'anonyme\' || id || \'@anonyme.fr\''),
				'email_verified_at' => null,
			]);
	}
}

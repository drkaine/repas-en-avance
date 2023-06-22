<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Helpers\GestionUsersInactifHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class SuppressionEnDBTest extends TestCase
{
	use RefreshDatabase;

	public function testSuppressionUsersAnonyme(): void
	{
		$date = new Carbon;

		$donnee_user = [
			'email' => 'anonyme1@anonyme.fr',
			'nom' => 'Anonyme',
			'password' => bcrypt('anonyme'),
			'email_verified_at' => null,
			'derniere_connexion' => $date->now()->subMonths(7),
		];

		$user = new User;

		$user->create($donnee_user);

		$anonymisation_helper = new GestionUsersInactifHelper;

		$anonymisation_helper->supprimer();

		$this->assertDatabaseMissing('users', $donnee_user);
	}
}

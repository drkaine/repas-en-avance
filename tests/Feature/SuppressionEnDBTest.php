<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\TagUser;
use App\Models\User;
use App\Services\GestionUsersInactifServices;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class SuppressionEnDBTest extends TestCase
{
	use RefreshDatabase;

	public function testSuppressionUsersAnonymes(): void
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

		$anonymisation_helper = new GestionUsersInactifServices;

		$anonymisation_helper->supprimer();

		$this->assertDatabaseMissing('users', $donnee_user);
	}

	public function testSuppressionTagsUserDesUsersAnonymes(): void
	{
		$date = new Carbon;

		$donnee_user = [
			'email' => 'anonyme1@anonyme.fr',
			'nom' => 'Anonyme',
			'password' => bcrypt('anonyme'),
			'email_verified_at' => null,
			'derniere_connexion' => $date->now()->subMonths(7),
		];

		$donnee_tags_user = [
			'id_user' => 1,
			'id_tag' => 1,
		];

		$user = new User;

		$user->create($donnee_user);

		$tags_user = new TagUser;
		$tags_user->factory()->create($donnee_tags_user);

		$anonymisation_helper = new GestionUsersInactifServices;

		$anonymisation_helper->supprimer();

		$this->assertDatabaseMissing('tags_user', $donnee_tags_user);
	}
}

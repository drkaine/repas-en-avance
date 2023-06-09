<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ColonneNullModeleEnDBTest extends TestCase
{
	use RefreshDatabase;

	public function testDeLaTableUsersChampsEmailVerifiedAt(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => null,
			'derniere_connexion' => '06-06-2023 06:06:06',
		];

		User::factory()->create($user);

		unset($user['password']);

		$this->assertDatabaseHas('users', $user);
	}

	public function testDeLaTableUsersChampsDerniereConnexion(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => null,
		];

		User::factory()->create($user);

		unset($user['password']);

		$this->assertDatabaseHas('users', $user);
	}
}

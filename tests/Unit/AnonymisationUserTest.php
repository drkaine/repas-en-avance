<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AnonymisationUserTest extends TestCase
{
	use RefreshDatabase;

	public function testAnonymisationUser(): void
	{
		$donnee_user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		];

		$user = User::factory()->create($donnee_user);

		unset($donnee_user['password']);

		$this->actingAs($user);

		$this->get('/anonymisation_du_compte');

		$this->assertDatabaseMissing('users', $donnee_user);

		$this->assertDatabaseHas('users', [
			'email' => 'anonyme' . $user->id . '@anonyme.fr',
			'nom' => 'Anonyme',
			'derniere_connexion' => null,
			'email_verified_at' => null,
		]);
	}
}

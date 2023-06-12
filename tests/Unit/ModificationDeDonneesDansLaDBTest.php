<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ModificationDeDonneesDansLaDBTest extends TestCase
{
	use RefreshDatabase;

	public function testModificationDuUser(): void
	{
		$donnee_user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
		];

		$donnee_user_modifie = [
			'nom' => 'Test user modifié',
			'email' => 'email_modifie@test.fr',
		];

		$user = User::factory()->create($donnee_user);

		unset($donnee_user['password']);

		$this->actingAs($user);

		$this->post('/modification_user', $donnee_user_modifie);

		$this->assertDatabaseMissing('users', $donnee_user);

		$this->assertDatabaseHas('users', $donnee_user_modifie);
	}
}

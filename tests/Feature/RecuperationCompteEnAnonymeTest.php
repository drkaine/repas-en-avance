<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class RecuperationCompteEnAnonymeTest extends TestCase
{
	use RefreshDatabase;

	public function testRecuperation(): void
	{
		$donnee_user = [
			'email' => 'anonyme1@anonyme.fr',
			'nom' => 'Anonyme',
			'password' => bcrypt('anonyme'),
		];

		$donnee_user_recupere = [
			'email_anonyme' => 'anonyme1@anonyme.fr',
			'email' => 'test@test.fr',
			'nom' => 'test',
			'password' => 'anonyme',
		];

		$user = new User;

		$user->create($donnee_user);

		unset($donnee_user['password']);

		$this->post('/recuperation_compte', $donnee_user_recupere);

		unset($donnee_user_recupere['email_anonyme'], $donnee_user_recupere['password']);

		$this->assertDatabaseMissing('users', $donnee_user);

		$this->assertDatabaseHas('users', $donnee_user_recupere);
	}
}

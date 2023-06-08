<?php

declare(strict_types = 1);

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AjoutDansLaDBTest extends TestCase
{
	use RefreshDatabase;

	public function testCréationDUnUserApresLInscription(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'password_confirmation' => 'password',
		];

		$this->post('/inscription', $user);

		unset($user['password'], $user['password_confirmation']);

		$this->assertDatabaseHas('users', $user);
	}
}

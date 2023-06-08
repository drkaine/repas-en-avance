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

	public function testCreationDUnUserApresLInscription(): void
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

	public function testCreationDUnTag(): void
	{
		$tag = [
			'nom' => 'Catégorie',
		];

		$this->post('/ajout_tag', $tag);

		$this->assertDatabaseHas('tags', $tag);
	}
}

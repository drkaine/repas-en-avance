<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ModeleDesTablesEnDBTest extends TestCase
{
	use RefreshDatabase;

	public function testLaTableUser(): void
	{
		User::factory()->create([
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		]);

		$this->assertDatabaseHas('users', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		]);
	}
}

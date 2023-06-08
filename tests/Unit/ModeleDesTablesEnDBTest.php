<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ModeleDesTablesEnDBTest extends TestCase
{
	use RefreshDatabase;

	public function testLaTableUsers(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		];

		User::factory()->create($user);

		unset($user['password']);

		$this->assertDatabaseHas('users', $user);
	}

	public function testLaTableTags(): void
	{
		$tag = [
			'nom' => 'Catégorie',
		];

		Tag::factory()->create($tag);

		$this->assertDatabaseHas('tags', $tag);
	}
}

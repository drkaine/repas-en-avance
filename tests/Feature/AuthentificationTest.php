<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AuthentificationTest extends TestCase
{
	use RefreshDatabase;

	public function testConnexion(): void
	{
		$donnee_user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
		];

		$user = User::factory()->create($donnee_user);

		unset($donnee_user['nom']);

		$this->post('/connexion', $donnee_user);

		$this->assertSame($user->id, Auth::user()->id);
	}

	public function testDeconnexion(): void
	{
		$donnee_user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
		];

		$user = User::factory()->create($donnee_user);

		$this->actingAs($user);

		$this->get('deconnexion');

		$this->assertGuest();
	}
}

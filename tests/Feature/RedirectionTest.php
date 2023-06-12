<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class RedirectionTest extends TestCase
{
	use RefreshDatabase;

	public function testDeconnexion(): void
	{
		$response = $this->get('deconnexion');

		$response->assertRedirect('/');
	}

	public function testAnonymisationUser(): void
	{
		$donnee_user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
		];
		$user = User::factory()->create($donnee_user);

		$this->actingAs($user);

		$response = $this->get('/anonymisation_du_compte');

		$response->assertRedirect('deconnexion');
	}
}

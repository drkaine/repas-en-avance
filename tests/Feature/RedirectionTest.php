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

	public function testModificationDesDonneesDuUser(): void
	{
		$donnee_user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
		];

		User::factory()->create($donnee_user);

		$donnee_user_modifie = [
			'nom' => 'Test user modifié',
			'email' => 'email_modifie@test.fr',
			'password' => 'password',
		];

		$response = $this->post('/modification_user', $donnee_user_modifie);

		$response->assertRedirect('/');
	}
}

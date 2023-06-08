<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class EnvoieFormulaireTest extends TestCase
{
	use RefreshDatabase;

	public function testInscriptionAvecEnvoiDuFormulaire(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(201);
	}

	public function testConnexionAvecEnvoiDuFormulaire(): void
	{
		User::factory()->create([
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
		]);

		$response = $this->post('/connexion', [
			'email' => 'email@test.fr',
			'password' => 'password',
		]);

		$response->assertStatus(201);
	}
}

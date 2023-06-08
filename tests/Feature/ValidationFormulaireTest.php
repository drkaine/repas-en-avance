<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ValidationFormulaireTest extends TestCase
{
	use RefreshDatabase;

	public function testNomDansInscription(): void
	{
		$response = $this->post('/inscription', [
			'nom' => '',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testEmailFDansInscription(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => '',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testPasswordDansInscription(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => '',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testPasswordConfirmationDansInscription(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
		]);

		$response->assertStatus(302);
	}
}

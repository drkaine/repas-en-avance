<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationChampsFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ValidationChampsFormulaireInscriptionTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsNom(): void
	{
		$response = $this->post('/inscription', [
			'nom' => null,
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testChampsEmail(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => null,
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsEmail(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testFormatChampsEmail(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'emailestfr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testChampsPassword(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => null,
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumPassword(): void
	{
		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'p',
			'email_verified_at' => '2023-06-06 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testChampsPasswordConfirmation(): void
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

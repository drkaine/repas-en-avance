<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class MotDePasseOublieTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsEmail(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			'email' => null,
			'password' => 'password',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsEmail(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
			'password' => 'password',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsEmail(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			'email' => 'a@afr',
			'password' => 'password',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testFormatChampsEmail(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			'email' => 'emailestfr',
			'password' => 'password',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testChampsMotDePasse(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			[
				'email' => 'anonyme@anonnyme.fr',
				'password' => null,
				'password_confirmation' => 'password',
			],
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsPassword(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			'email' => 'email.test.fr',
			'password' => 'fg',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsPassword(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			'email' => 'email.test.fr',
			'password' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testChampsMotDePasseConfirme(): void
	{
		$response = $this->post('/mot-de-passe-oublie', [
			[
				'email' => 'anonyme@anonnyme.fr',
				'password' => 'password',
				'password_confirmation' => null,
			],
		]);

		$response->assertStatus(302);
	}
}

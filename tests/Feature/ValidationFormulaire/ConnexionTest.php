<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ConnexionTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsEmail(): void
	{
		$response = $this->post('/connexion', [
			'email' => null,
			'password' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsEmail(): void
	{
		$response = $this->post('/connexion', [
			'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
			'password' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsEmail(): void
	{
		$response = $this->post('/connexion', [
			'email' => 'a@afr',
			'password' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testFormatChampsEmail(): void
	{
		$response = $this->post('/connexion', [
			'email' => 'emailestfr',
			'password' => 'password',
		]);

		$response->assertStatus(302);
	}

	public function testChampsPassword(): void
	{
		$response = $this->post('/connexion', [
			'email' => 'email.test.fr',
			'password' => null,
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsPassword(): void
	{
		$response = $this->post('/connexion', [
			'email' => 'email.test.fr',
			'password' => 'fg',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsPassword(): void
	{
		$response = $this->post('/connexion', [
			'email' => 'email.test.fr',
			'password' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio',
		]);

		$response->assertStatus(302);
	}
}

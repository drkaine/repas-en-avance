<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class DemandeMotDePasseOublieTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsEmail(): void
	{
		$response = $this->post('/demande-mot-de-passe-oublie', [
			'email' => null,
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsEmail(): void
	{
		$response = $this->post('/demande-mot-de-passe-oublie', [
			'email' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio@azertyuiopmlkjhgfdsqwxczertyuiopmlkjhgfdsqwxcv.fr',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsEmail(): void
	{
		$response = $this->post('/demande-mot-de-passe-oublie', [
			'email' => 'a@afr',
		]);

		$response->assertStatus(302);
	}

	public function testFormatChampsEmail(): void
	{
		$response = $this->post('/demande-mot-de-passe-oublie', [
			'email' => 'emailestfr',
		]);

		$response->assertStatus(302);
	}
}

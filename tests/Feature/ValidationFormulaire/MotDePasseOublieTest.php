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
		]);

		$response->assertStatus(302);
	}

	public function testChampsMotDePasse(): void
	{
		$response = $this->post('/demande-mot-de-passe-oublie', [
			[
				'email' => 'anonyme@anonnyme.fr',
				'password' => null,
			],
		]);

		$response->assertStatus(302);
	}
}

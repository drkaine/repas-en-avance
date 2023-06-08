<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class AffichageDesPagesTest extends TestCase
{
	public function testAccueil(): void
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testInscription(): void
	{
		$response = $this->get('inscription');

		$response->assertStatus(200);
	}

	public function testConnexion(): void
	{
		$response = $this->get('connexion');

		$response->assertStatus(200);
	}
}

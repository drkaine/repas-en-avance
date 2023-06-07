<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class AffichageDesPagesTest extends TestCase
{
	public function testAffichageAccueil(): void
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testAffichageInscription(): void
	{
		$response = $this->get('inscription');

		$response->assertStatus(200);
	}
}

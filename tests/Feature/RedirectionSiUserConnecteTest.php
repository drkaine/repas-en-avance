<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class RedirectionSiUserConnecteTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	public function testInscription(): void
	{
		$this->userConnecte();

		$response = $this->get('inscription');

		$response->assertRedirect('mon_compte');
	}

	public function testConnexion(): void
	{
		$this->userConnecte();

		$response = $this->get('connexion');

		$response->assertRedirect('mon_compte');
	}
}

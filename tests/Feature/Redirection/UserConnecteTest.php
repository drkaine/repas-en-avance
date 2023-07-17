<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class UserConnecteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	public function testInscription(): void
	{
		$this->userConnecte();

		$response = $this->get('inscription');

		$response->assertRedirect('mon-compte');
	}

	public function testConnexion(): void
	{
		$this->userConnecte();

		$response = $this->get('connexion');

		$response->assertRedirect('mon-compte');
	}
}

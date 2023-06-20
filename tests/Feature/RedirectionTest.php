<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class RedirectionTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	private array $user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
	}

	public function testDeconnexion(): void
	{
		$response = $this->get('deconnexion');

		$response->assertRedirect('/');
	}

	public function testAnonymisationUser(): void
	{
		$this->userConnecte();

		$response = $this->get('/anonymisation_du_compte');

		$response->assertRedirect('deconnexion');
	}

	public function testModificationDesDonneesDuUser(): void
	{
		$this->userConnecte();

		unset($this->user['password']);

		$this->user['regimes_alimentaires'] = [];

		$response = $this->post('/modification_user', $this->user);

		$response->assertRedirect('/');
	}
}

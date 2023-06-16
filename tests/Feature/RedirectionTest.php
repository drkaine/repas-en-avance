<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class RedirectionTest extends TestCase
{
	use RefreshDatabase;

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
		$this->creationUserConnecte();

		$response = $this->get('/anonymisation_du_compte');

		$response->assertRedirect('deconnexion');
	}

	public function testModificationDesDonneesDuUser(): void
	{
		$this->creationUserConnecte();

		unset($this->user['password']);

		$response = $this->post('/modification_user', $this->user);

		$response->assertRedirect('/');
	}

	private function creationUserConnecte(): void
	{
		$user = new User;

		$user = $user->factory()->create($this->user);

		$this->actingAs($user);
	}
}

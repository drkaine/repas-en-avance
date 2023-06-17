<?php

declare(strict_types = 1);

namespace Tests\Feature\TestDansLaDB;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class AnonymisationUserTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	private array $user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
	}

	public function testAnonymisationUser(): void
	{
		$user = $this->user();

		unset($this->user['password']);

		$this->actingAs($user);

		$this->get('/anonymisation_du_compte');

		$this->assertDatabaseMissing('users', $this->user);

		$this->assertDatabaseHas('users', [
			'email' => 'anonyme' . $user->id . '@anonyme.fr',
			'nom' => 'Anonyme',
			'derniere_connexion' => null,
			'email_verified_at' => null,
		]);
	}
}
<?php

declare(strict_types = 1);

namespace Tests\Feature\TestDansLaDB;

use App\Services\GestionUsersInactifServices;
use Carbon\Carbon;
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
			'email_verified_at' => null,
		]);
	}

	public function testAnonymisationUsersInactif(): void
	{
		$date = new Carbon;

		$user = $this->user();

		$user->derniere_connexion = $date->now()->subMonths(4);

		$user->save();

		$anonymisation_helper = new GestionUsersInactifServices;

		$anonymisation_helper->anonymiser();

		$this->assertDatabaseMissing('users', $this->user);

		$this->assertDatabaseHas('users', [
			'email' => 'anonyme' . $user->id . '@anonyme.fr',
			'nom' => 'Anonyme',
			'email_verified_at' => null,
		]);
	}
}

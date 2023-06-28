<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Services\GestionUsersInactifServices;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class AnonymisationUserTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
	}

	public function testAnonymisationUser(): void
	{
		$user = $this->user();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->get('/anonymisation_du_compte');

		$this->assertDatabaseMissing('users', $this->donnees_user);

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

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', [
			'email' => 'anonyme' . $user->id . '@anonyme.fr',
			'nom' => 'Anonyme',
			'email_verified_at' => null,
		]);
	}
}

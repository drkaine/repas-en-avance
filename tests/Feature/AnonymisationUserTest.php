<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Services\GestionUsersInactifServices;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class AnonymisationUserTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	private array $donnees_user_anonyme;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
		$this->donnees_user_anonyme = $this->donneesUserAnonyme();
		unset($this->donnees_user_anonyme['password'], $this->donnees_user_anonyme['derniere_connexion']);

	}

	public function testAnonymisationUser(): void
	{
		$user = $this->creationUser();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->get('/anonymisation_du_compte');

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', $this->donnees_user_anonyme);
	}

	public function testAnonymisationUsersInactif(): void
	{
		$date = new Carbon;

		$user = $this->creationUser();

		$user->derniere_connexion = $date->now()->subMonths(4);

		$user->save();

		$anonymisation_helper = new GestionUsersInactifServices;

		$anonymisation_helper->anonymiser();

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', $this->donnees_user_anonyme);
	}
}

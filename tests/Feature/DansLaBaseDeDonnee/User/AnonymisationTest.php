<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\User;

use App\Services\GestionUsersInactifService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class AnonymisationTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	private array $donnees_user_anonyme;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_user_anonyme = $this->donnees('user_anonyme');
		unset($this->donnees_user_anonyme['password'], $this->donnees_user_anonyme['derniere_connexion']);

	}

	public function testAnonymisationUser(): void
	{
		$user = $this->creationUser();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->get('/anonymisation-du-compte');

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', $this->donnees_user_anonyme);
	}

	public function testAnonymisationUsersInactif(): void
	{
		$date = new Carbon;

		$user = $this->creationUser();

		$user->derniere_connexion = $date->now()->subMonths(4);

		$user->save();

		$anonymisation_helper = new GestionUsersInactifService;

		$anonymisation_helper->anonymiser();

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', $this->donnees_user_anonyme);
	}
}

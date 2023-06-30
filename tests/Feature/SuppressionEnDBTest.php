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
class SuppressionEnDBTest extends TestCase
{
	use RecuperationDonneesDeTestTrait;
	use ModelDeTestTrait;
	use RefreshDatabase;

	private array $donnees_user_anonyme;

	private GestionUsersInactifServices $anonymisation_helper;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user_anonyme = $this->donneesUser();

		$this->anonymisation_helper = new GestionUsersInactifServices;

		$this->creationUserAnonyme();
	}

	public function testUsersAnonymes(): void
	{
		$this->anonymisation_helper->supprimer();

		$this->assertDatabaseMissing('users', $this->donnees_user_anonyme);
	}

	public function testTagsUserDesUsersAnonymes(): void
	{
		$date = new Carbon;

		$donnees_user_anonyme['derniere_connexion'] = $date->now()->subMonths(7);

		$this->creationTagsUser();

		$this->anonymisation_helper->supprimer();

		$this->assertDatabaseMissing('tags_user', $this->donneesTagUser());
	}
}

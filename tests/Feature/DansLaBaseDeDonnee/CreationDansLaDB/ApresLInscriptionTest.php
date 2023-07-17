<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\Creation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class ApresLInscriptionTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_user['password_confirmation'] = 'password';

	}

	public function testUserApresLInscription(): void
	{
		$this->donnees_user['regimes_alimentaires'] = [];

		$this->post('/inscription', $this->donnees_user);

		unset($this->donnees_user['password'], $this->donnees_user['password_confirmation'], $this->donnees_user['regimes_alimentaires']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testUserTagApresLInscription(): void
	{
		$this->donnees_user['regimes_alimentaires'] = [
			'2',
		];

		$this->post('/inscription', $this->donnees_user);

		$this->creationTag();

		$this->assertDatabaseHas('regimes_alimentaires', $this->donnees('regime_alimentaire'));
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class RedirectionTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	private array $donnees_user_anonyme;

	private array $donnees_user_anonyme_recupere;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_user_anonyme = $this->donnees('user_anonyme');
		$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');
	}

	public function testDeconnexion(): void
	{
		$response = $this->get('deconnexion');

		$response->assertRedirect('/');
	}

	public function testAnonymisationUser(): void
	{
		$this->userConnecte();

		$response = $this->get('/anonymisation-du-compte');

		$response->assertRedirect('deconnexion');
	}

	public function testModificationDesDonneesDuUser(): void
	{
		$this->userConnecte();

		unset($this->donnees_user['password']);

		$this->donnees_user['tags_regimes_alimentaires'] = [];

		$response = $this->post('/modification-user', $this->donnees_user);

		$response->assertRedirect('/');
	}

	public function testRecuperationCompte(): void
	{
		$this->creation('User', 'user_anonyme');

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertRedirect('/');
	}
}

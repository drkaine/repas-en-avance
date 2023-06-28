<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
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

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
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

		unset($this->donnees_user['password']);

		$this->donnees_user['regimes_alimentaires'] = [];

		$response = $this->post('/modification_user', $this->donnees_user);

		$response->assertRedirect('/');
	}

	public function testRecuperationCompte(): void
	{
		$donnee_user_recupere = [
			'email_anonyme' => 'anonyme1@anonyme.fr',
			'email' => 'test@test.fr',
			'nom' => 'test',
			'password' => 'anonyme',
		];

		$user = new User;

		$user->create([
			'email' => 'anonyme1@anonyme.fr',
			'nom' => 'Anonyme',
			'password' => bcrypt('anonyme'),
		]);

		$response = $this->post('/recuperation_compte', $donnee_user_recupere);

		$response->assertRedirect('/');
	}
}

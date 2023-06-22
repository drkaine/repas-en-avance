<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class RedirectionTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

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
		$this->userConnecte();

		$response = $this->get('/anonymisation_du_compte');

		$response->assertRedirect('deconnexion');
	}

	public function testModificationDesDonneesDuUser(): void
	{
		$this->userConnecte();

		unset($this->user['password']);

		$this->user['regimes_alimentaires'] = [];

		$response = $this->post('/modification_user', $this->user);

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

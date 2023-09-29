<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class MotDePasseOublieTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $mot_de_passe_oublie;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');

		$this->mot_de_passe_oublie = $this->donnees('mot_de_passe_oublie');

		$user = $this->creationUser();
	}

	public function testChangementMotDePasse(): void
	{
		$this->post('/mot-de-passe-oublie', $this->mot_de_passe_oublie);

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->donnees_user['password'] = $this->mot_de_passe_oublie['password'];

		$user = new User;

		$user = $user->first();

		$this->assertTrue(password_verify($this->mot_de_passe_oublie['password'], $user->password));
	}
}

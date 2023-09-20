<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class AuthentificationTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
	}

	public function testConnexion(): void
	{
		$user = $this->creationUser();

		unset($this->donnees_user['nom'], $this->donnees_user['email_verified_at']);

		$this->post('/connexion', $this->donnees_user);

		$this->assertSame($user->id, Auth::user()->id);
	}

	public function testConnexionUserNonConfirme(): void
	{
		$user = $this->creationUserNonConfirme();

		unset($this->donnees_user['nom'], $this->donnees_user['email_verified_at']);

		$response = $this->post('/connexion', $this->donnees_user);

		$response->assertRedirect('inscription');
	}

	public function testDeconnexion(): void
	{
		$this->userConnecte();

		$this->get('deconnexion');

		$this->assertGuest();
	}
}

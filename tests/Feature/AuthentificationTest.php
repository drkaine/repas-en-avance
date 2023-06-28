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

		$this->donnees_user = $this->donneesUser();
	}

	public function testConnexion(): void
	{
		$user = $this->creationUser();

		unset($this->donnees_user['nom']);

		$this->post('/connexion', $this->donnees_user);

		$this->assertSame($user->id, Auth::user()->id);
	}

	public function testDeconnexion(): void
	{
		$this->userConnecte();

		$this->get('deconnexion');

		$this->assertGuest();
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class AuthentificationTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	private array $user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
	}

	public function testConnexion(): void
	{
		$user = $this->user();

		unset($this->user['nom']);

		$this->post('/connexion', $this->user);

		$this->assertSame($user->id, Auth::user()->id);
	}

	public function testDeconnexion(): void
	{
		$this->userConnecte();

		$this->get('deconnexion');

		$this->assertGuest();
	}
}

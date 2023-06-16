<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AuthentificationTest extends TestCase
{
	use RefreshDatabase;

	private array $user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
	}

	public function testConnexion(): void
	{
		$user = $this->creationUser();

		unset($this->user['nom']);

		$this->post('/connexion', $this->user);

		$this->assertSame($user->id, Auth::user()->id);
	}

	public function testDeconnexion(): void
	{
		$user = $this->creationUser();

		$this->actingAs($user);

		$this->get('deconnexion');

		$this->assertGuest();
	}

	private function creationUser(): User
	{
		$user = new User;

		$user = $user->factory()->create($this->user);

		return $user;
	}
}

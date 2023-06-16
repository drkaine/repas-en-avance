<?php

declare(strict_types = 1);

namespace Tests\Feature\TestDansLaDB;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreationModelDeTestTrait;

/**
 * @coversNothing
 */
class ModificationDeDonneesDansLaDBTest extends TestCase
{
	use RefreshDatabase;
	use CreationModelDeTestTrait;

	private array $user;

	private array $user_modifie;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');

		$this->user_modifie = config('donnee_de_test.user_modifie');
	}

	public function testModificationDuUser(): void
	{
		$user = $this->user();

		unset($this->user['password']);

		$this->actingAs($user);

		$this->post('/modification_user', $this->user_modifie);

		$this->assertDatabaseMissing('users', $this->user);

		$this->assertDatabaseHas('users', $this->user_modifie);
	}
}

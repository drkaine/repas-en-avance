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
class RecuperationDonneesAnonymiserTest extends TestCase
{
	use RecuperationDonneesDeTestTrait;
	use ModelDeTestTrait;
	use RefreshDatabase;

	private array $donnees_user_anonyme;

	private array $donnees_user_anonyme_recupere;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user_anonyme = $this->donneesUser();

		$this->donnees_user_anonyme_recupere = $this->donneesUserAnonymeRecupere();

		$this->creationUserAnonyme();
	}

	public function testRecuperationCompteUser(): void
	{
		$this->post('/recuperation_compte', $this->donnees_user_anonyme_recupere);

		unset($this->donnees_user_anonyme_recupere['email_anonyme'], $this->donnees_user_anonyme_recupere['password']);

		$this->assertDatabaseMissing('users', $this->donnees_user_anonyme);

		$this->assertDatabaseHas('users', $this->donnees_user_anonyme_recupere);
	}
}

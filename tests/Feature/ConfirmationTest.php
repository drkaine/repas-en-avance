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
class ConfirmationTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	public function testInscriptionUser(): void
	{
		$user = $this->creationUser();

		$donnees_user = $this->donneesUser();

		$donnees_user['email_verified_at'] = null;

		$this->get('confirmation_email/' . $user->id);

		$this->assertDatabaseMissing('users', $donnees_user);

		$this->assertNotSame($user->email_verified_at, null);
	}
}

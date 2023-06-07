<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ValidationFormulaireTest extends TestCase
{
	public function testValidationNomFormulaireInscription(): void
	{
		$response = $this->post('/inscription', [
			'nom' => '',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => '06-06-2023 06:06:06',
			'password_confirmation' => 'password',
		]);

		$response->assertStatus(302);
	}
}

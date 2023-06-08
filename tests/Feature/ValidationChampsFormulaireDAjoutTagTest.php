<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ValidationChampsFormulaireDAjoutTagTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsNom(): void
	{
		$response = $this->post('/ajout_tag', [
			'nom' => '',
		]);

		$response->assertStatus(302);
	}
}

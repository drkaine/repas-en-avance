<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AjoutTagTest extends TestCase
{
	use RefreshDatabase;

	public function testChampsNom(): void
	{
		$response = $this->post('/ajout_tag', [
			'nom' => null,
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$response = $this->post('/ajout_tag', [
			'nom' => 'azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv',
		]);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsNom(): void
	{
		$response = $this->post('/ajout_tag', [
			'nom' => 'az',
		]);

		$response->assertStatus(302);
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class RecuperationCompteTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user_anonyme_recupere;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');
	}

	public function testChampsNom(): void
	{
		$this->donnees_user_anonyme_recupere['nom'] = null;

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$this->donnees_user_anonyme_recupere['nom'] = 'aztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsNom(): void
	{
		$this->donnees_user_anonyme_recupere['nom'] = 'az';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testChampsEmail(): void
	{
		$this->donnees_user_anonyme_recupere['email'] = null;

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsEmail(): void
	{
		$this->donnees_user_anonyme_recupere['email'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsEmail(): void
	{
		$this->donnees_user_anonyme_recupere['email'] = 'a@.fr';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testFormatChampsEmail(): void
	{
		$this->donnees_user_anonyme_recupere['email'] = 'emailestfr';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testChampsPassword(): void
	{
		$this->donnees_user_anonyme_recupere['password'] = null;

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumPassword(): void
	{
		$this->donnees_user_anonyme_recupere['password'] = 'p';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumPassword(): void
	{
		$this->donnees_user_anonyme_recupere['password'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertStatus(302);
	}
}

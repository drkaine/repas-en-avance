<?php

declare(strict_types = 1);

namespace Tests\Feature\ValidationFormulaire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class InscriptionTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();

		$this->donnees_user['email_verified_at'] = '2023-06-06 06:06:06';

		$this->donnees_user['password_confirmation'] = 'password';
	}

	public function testChampsNom(): void
	{
		$this->donnees_user['nom'] = null;

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsNom(): void
	{
		$this->donnees_user['nom'] = 'aztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvaztrhgertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhgfdsqwxcv';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsNom(): void
	{
		$this->donnees_user['nom'] = 'az';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testChampsEmail(): void
	{
		$this->donnees_user['email'] = null;

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumChampsEmail(): void
	{
		$this->donnees_user['email'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumChampsEmail(): void
	{
		$this->donnees_user['email'] = 'a@.fr';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testFormatChampsEmail(): void
	{
		$this->donnees_user['email'] = 'emailestfr';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testChampsPassword(): void
	{
		$this->donnees_user['password'] = null;

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testLongueurMinimumPassword(): void
	{
		$this->donnees_user['password'] = 'p';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testLongueurMaximumPassword(): void
	{
		$this->donnees_user['password'] = 'azertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuioazertyuiopmlkjhgfdsqwxcvbnazertyuio';

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(302);
	}

	public function testChampsPasswordConfirmation(): void
	{
		unset($this->donnees_user['password_confirmation']);

		$response = $this->post('/inscription', [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
		]);

		$response->assertStatus(302);
	}
}

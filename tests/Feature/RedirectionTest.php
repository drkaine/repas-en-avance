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
class RedirectionTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	private array $donnees_user_anonyme;

	private array $donnees_user_anonyme_recupere;

	private array $donnes_carnet_recettes;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_user_anonyme = $this->donnees('user_anonyme');
		$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');
		$this->donnes_carnet_recettes = $this->donnees('carnet_recette');
	}

	public function testDeconnexion(): void
	{
		$response = $this->get('deconnexion');

		$response->assertRedirect('/');
	}

	public function testAnonymisationUser(): void
	{
		$this->userConnecte();

		$response = $this->get('/anonymisation-du-compte');

		$response->assertRedirect('deconnexion');
	}

	public function testModificationDesDonneesDuUser(): void
	{
		$this->userConnecte();

		unset($this->donnees_user['password']);

		$this->donnees_user['tags_regimes_alimentaires'] = [];

		$response = $this->post('/modification-user', $this->donnees_user);

		$response->assertRedirect('/');
	}

	public function testRecuperationCompte(): void
	{
		$this->creation('User', 'user_anonyme');

		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertRedirect('/');
	}

	public function testAjoutCarnetRecettes(): void
	{
		$response = $this->post('/ajout-carnet-recettes', $this->donnes_carnet_recettes);

		$response->assertRedirect('/');
	}
}

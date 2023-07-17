<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\User;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class ModificationTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_user_modifie;

	private array $tags_regimes_alimentaire;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');

		$this->donnees_user_modifie = $this->donnees('user_modifie');

		$this->tags_regimes_alimentaire = config('donnee_de_test.tags_regimes_alimentaire');
	}

	public function testDuUser(): void
	{
		$user = $this->creationUser();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->post('/modification-user', $this->donnees_user_modifie);

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', $this->donnees_user_modifie);
	}

	public function testDuRegimeAlimentaire(): void
	{
		$user = $this->creationUser();

		$this->creationRegimesAlimentaire();

		$this->creationRegimeAlimentaire();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->donnees_user_modifie['tags_regimes_alimentaires'] = [
			'3',
		];

		$this->post('/modification-user', $this->donnees_user_modifie);

		$this->assertDatabaseMissing('regimes_alimentaires', $this->donnees('regime_alimentaire'));

		$this->assertDatabaseHas('regimes_alimentaires', $this->donnees('regime_alimentaire_modifie'));
	}

	public function testDeLaDerniereConnexionDuUser(): void
	{
		$date = new Carbon;

		$this->creationUser();

		unset($this->donnees_user['nom']);

		$this->post('/connexion', $this->donnees_user);

		unset($this->donnees_user['password']);

		$this->donnees_user['derniere_connexion'] = $date->now();

		$this->assertDatabaseHas('users', $this->donnees_user);
	}
}

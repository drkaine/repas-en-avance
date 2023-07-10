<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class ModificationDeDonneesDansLaDBTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_user_modifie;

	private array $tags_regimes_alimentaire;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();

		$this->donnees_user_modifie = $this->donneesUserModifie();

		$this->tags_regimes_alimentaire = config('donnee_de_test.tags_regimes_alimentaire');
	}

	public function testModificationDuUser(): void
	{
		$user = $this->creationUser();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->post('/modification-user', $this->donnees_user_modifie);

		$this->assertDatabaseMissing('users', $this->donnees_user);

		$this->assertDatabaseHas('users', $this->donnees_user_modifie);
	}

	public function testModificationDuRegimeAlimentaire(): void
	{
		$user = $this->creationUser();

		$this->creationRegimesAlimentaire();

		$this->creationTagsUser();

		unset($this->donnees_user['password']);

		$this->actingAs($user);

		$this->donnees_user_modifie['regimes_alimentaires'] = [
			3,
		];

		$this->post('/modification-user', $this->donnees_user_modifie);

		$this->assertDatabaseMissing('tags_user', $this->donneesTagUser());

		$this->assertDatabaseHas('tags_user', $this->donneesTagUserModifie());
	}

	public function testModificationDeLaDerniereConnexionDuUser(): void
	{
		$this->creationUser();

		unset($this->donnees_user['nom']);

		$this->post('/connexion', $this->donnees_user);

		unset($this->donnees_user['password']);

		$this->donnees_user['derniere_connexion'] = date('Y-m-d');

		$this->assertDatabaseHas('users', $this->donnees_user);
	}
}

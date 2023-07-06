<?php

declare(strict_types = 1);

namespace Tests\Feature\TableSQL;

use App\Models\Recette;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class ColonneNullTest extends TestCase
{
	use RefreshDatabase;
	use RecuperationDonneesDeTestTrait;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
		$this->donnees_recette = $this->donneesRecette();

		$this->donnees_recette['ingredients'] = [
			'Carotte' => 2,
		];

		$this->donnees_recette['quantites'] = [
			'Carotte' => 1,
		];
	}

	public function testDeLaTableUsersChampsEmailVerifiedAt(): void
	{
		$this->donnees_user['email_verified_at'] = null;

		$this->creationUser();

		unset($this->donnees_user['password']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testDeLaTableUsersChampsDerniereConnexion(): void
	{
		$this->donnees_user['derniere_connexion'] = null;

		$this->creationUser();

		unset($this->donnees_user['password']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testDeLaTableRecetteChampsTempsCuisson(): void
	{
		$this->donnees_recette['temps_cuisson'] = null;

		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testDeLaTableRecetteChampsTempsRepos(): void
	{
		$this->donnees_recette['temps_repos'] = null;

		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testDeLaTableRecetteChampsLien(): void
	{
		$this->donnees_recette['lien'] = null;

		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testDeLaTableRecetteChampsInstruction(): void
	{
		$this->donnees_recette['instruction'] = null;

		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testDeLaTableRecetteChampsDescription(): void
	{
		$this->donnees_recette['description'] = null;

		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testDeLaTableRecetteChampsReferenceLivre(): void
	{
		$this->donnees_recette['reference_livre'] = null;

		$this->creationRecette();

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testTagsRecette(): void
	{
		$this->creationTagsRecette();

		$this->assertDatabaseHas('tags_recette', $this->donneesTagRecette());
	}

	private function creationUser(): void
	{
		$user = new User;
		$user->factory()->create($this->donnees_user);
	}

	private function creationRecette(): void
	{
		$recette = new Recette;

		unset($this->donnees_recette['ingredients'], $this->donnees_recette['quantites']);

		$recette->factory()->create($this->donnees_recette);
	}
}

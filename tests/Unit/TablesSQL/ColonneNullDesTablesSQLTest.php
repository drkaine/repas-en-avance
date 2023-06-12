<?php

declare(strict_types = 1);

namespace Tests\Unit\TableSQL;

use App\Models\Recette;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ColonneNullDesTablesSQLTest extends TestCase
{
	use RefreshDatabase;

	private array $user;

	private array $tag;

	private array $recette;

	protected function setUp(): void
	{
		parent::setUp();

		$this->user = config('donnee_de_test.user');
		$this->tag = config('donnee_de_test.tag');
		$this->recette = config('donnee_de_test.recette');
	}

	public function testDeLaTableUsersChampsEmailVerifiedAt(): void
	{
		$this->user['email_verified_at'] = null;

		User::factory()->create($this->user);

		unset($this->user['password']);

		$this->assertDatabaseHas('users', $this->user);
	}

	public function testDeLaTableUsersChampsDerniereConnexion(): void
	{
		$this->user['derniere_connexion'] = null;

		User::factory()->create($this->user);

		unset($this->user['password']);

		$this->assertDatabaseHas('users', $this->user);
	}

	public function testDeLaTableRecetteChampsTempsCuisson(): void
	{
		$this->recette['temps_cuisson'] = null;

		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testDeLaTableRecetteChampsTempsRepos(): void
	{
		$this->recette['temps_repos'] = null;

		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testDeLaTableRecetteChampsLien(): void
	{
		$this->recette['lien'] = null;

		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testDeLaTableRecetteChampsInstruction(): void
	{
		$this->recette['instruction'] = null;

		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testDeLaTableRecetteChampsDescription(): void
	{
		$this->recette['description'] = null;

		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}

	public function testDeLaTableRecetteChampsReferenceLivre(): void
	{
		$this->recette['reference_livre'] = null;

		Recette::factory()->create($this->recette);

		$this->assertDatabaseHas('recettes', $this->recette);
	}
}

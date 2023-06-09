<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\Recette;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ColonneNullModeleEnDBTest extends TestCase
{
	use RefreshDatabase;

	public function testDeLaTableUsersChampsEmailVerifiedAt(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => null,
			'derniere_connexion' => '06-06-2023 06:06:06',
		];

		User::factory()->create($user);

		unset($user['password']);

		$this->assertDatabaseHas('users', $user);
	}

	public function testDeLaTableUsersChampsDerniereConnexion(): void
	{
		$user = [
			'nom' => 'Test user',
			'email' => 'email@test.fr',
			'password' => 'password',
			'email_verified_at' => '2023-06-06 06:06:06',
			'derniere_connexion' => null,
		];

		User::factory()->create($user);

		unset($user['password']);

		$this->assertDatabaseHas('users', $user);
	}

	public function testDeLaTableRecetteChampsTempsCuisson(): void
	{
		$recette = [
			'temps_preparation' => 1,
			'temps_cuisson' => null,
			'temps_repos' => 3,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
			'nom' => 'Carotte simple',
		];

		Recette::factory()->create($recette);

		$this->assertDatabaseHas('recettes', $recette);
	}

	public function testDeLaTableRecetteChampsTempsRepos(): void
	{
		$recette = [
			'temps_preparation' => 1,
			'temps_cuisson' => 3,
			'temps_repos' => null,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
			'nom' => 'Carotte simple',
		];

		Recette::factory()->create($recette);

		$this->assertDatabaseHas('recettes', $recette);
	}

	public function testDeLaTableRecetteChampsLien(): void
	{
		$recette = [
			'temps_preparation' => 1,
			'temps_cuisson' => 3,
			'temps_repos' => 2,
			'lien' => null,
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
			'nom' => 'Carotte simple',
		];

		Recette::factory()->create($recette);

		$this->assertDatabaseHas('recettes', $recette);
	}

	public function testDeLaTableRecetteChampsInstruction(): void
	{
		$recette = [
			'temps_preparation' => 1,
			'temps_cuisson' => 3,
			'temps_repos' => 2,
			'lien' => 'https://ici.fr',
			'instruction' => null,
			'description' => 'Recette simple et rapide',
			'reference_livre' => 'Tous en cuisine page 12',
			'nom' => 'Carotte simple',
		];

		Recette::factory()->create($recette);

		$this->assertDatabaseHas('recettes', $recette);
	}

	public function testDeLaTableRecetteChampsDescription(): void
	{
		$recette = [
			'temps_preparation' => 1,
			'temps_cuisson' => 3,
			'temps_repos' => 2,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => null,
			'reference_livre' => 'Tous en cuisine page 12',
			'nom' => 'Carotte simple',
		];

		Recette::factory()->create($recette);

		$this->assertDatabaseHas('recettes', $recette);
	}

	public function testDeLaTableRecetteChampsReferenceLivre(): void
	{
		$recette = [
			'temps_preparation' => 1,
			'temps_cuisson' => 3,
			'temps_repos' => 2,
			'lien' => 'https://ici.fr',
			'instruction' => 'Eplucher les carottes',
			'description' => 'Recette simple et rapide',
			'reference_livre' => null,
			'nom' => 'Carotte simple',
		];

		Recette::factory()->create($recette);

		$this->assertDatabaseHas('recettes', $recette);
	}
}

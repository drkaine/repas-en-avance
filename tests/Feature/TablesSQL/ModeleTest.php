<?php

declare(strict_types = 1);

namespace Tests\Feature\TablesSQL;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class ModeleTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_tag;

	private array $donnees_recette;

	private array $donnees_carnet_recette;

	private array $donnees_auteur;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_tag = $this->donnees('tag');
		$this->donnees_recette = $this->donnees('recette');
		$this->donnees_carnet_recette = $this->donnees('carnet_recette');
		$this->donnees_auteur = $this->donnees('auteur');
	}

	public function testUsers(): void
	{
		$this->donnees_user['email_verified_at'] = '2023-06-06 06:06:06';

		$this->donnees_user['derniere_connexion'] = '06-06-2023 06:06:06';

		$user = new User;

		$user->factory()->create($this->donnees_user);

		unset($this->donnees_user['password']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testTags(): void
	{
		$this->creation('Tag', 'tag');

		$this->assertDatabaseHas('tags', $this->donnees_tag);
	}

	public function testRelationTags(): void
	{
		$this->creation('RelationTag', 'relation_tag');

		$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag'));
	}

	public function testRecettes(): void
	{
		$this->creation('Recette', 'recette');

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testRegimeAlimentaire(): void
	{
		$this->creation('RegimeAlimentaire', 'regime_alimentaire');

		$this->assertDatabaseHas('regimes_alimentaires', $this->donnees('regime_alimentaire'));
	}

	public function testIngredient(): void
	{
		$this->creation('Ingredient', 'ingredient');

		$this->assertDatabaseHas('ingredients', $this->donnees('ingredient'));
	}

	public function testUstensile(): void
	{
		$this->creation('Ustensile', 'ustensile');

		$this->assertDatabaseHas('ustensiles', $this->donnees('ustensile'));
	}

	public function testModeDeCuisson(): void
	{
		$this->creation('ModeDeCuisson', 'mode_de_cuisson');

		$this->assertDatabaseHas('mode_de_cuissons', $this->donnees('mode_de_cuisson'));
	}

	public function testPhoto(): void
	{
		$this->creation('Photo', 'photo');

		$this->assertDatabaseHas('photos', $this->donnees('photo'));
	}

	public function testCarnetRecettes(): void
	{
		$this->creation('CarnetRecette', 'carnet_recette');

		$this->assertDatabaseHas('carnet_recettes', $this->donnees_carnet_recette);
	}

	public function testAuteur(): void
	{
		$this->creation('Auteur', 'auteur');

		$this->assertDatabaseHas('auteurs', $this->donnees_auteur);
	}

	public function testAuteurRecettes(): void
	{
		$donnees_auteur_recettes = $this->donnees('auteur_recette');

		$this->creation('AuteurRecette', 'auteur_recette');

		$this->assertDatabaseHas('auteur_recettes', $donnees_auteur_recettes);
	}
}

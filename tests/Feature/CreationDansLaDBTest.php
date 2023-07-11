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
class CreationDansLaDBTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_user;

	private array $donnees_tag;

	private array $donnees_recette;

	private array $donnees_ustensile;

	private array $donnees_mode_de_cuisson;

	private array $donnees_ingredient;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donnees('user');
		$this->donnees_tag = $this->donnees('tag');
		$this->donnees_recette = $this->donnees('recette');
		$this->donnees_ustensile = $this->donnees('ustensile');
		$this->donnees_mode_de_cuisson = $this->donnees('mode_de_cuisson');
		$this->donnees_ingredient = $this->donnees('ingredient');

		$this->donnees_recette['ingredients'] = [
			'Carotte' => 2,
		];

		$this->donnees_recette['quantites'] = [
			'Carotte' => 1,
		];
	}

	public function testUserApresLInscription(): void
	{
		$this->donnees_user['password_confirmation'] = 'password';

		$this->donnees_user['regimes_alimentaires'] = [];

		$this->post('/inscription', $this->donnees_user);

		unset($this->donnees_user['password'], $this->donnees_user['password_confirmation'], $this->donnees_user['regimes_alimentaires']);

		$this->assertDatabaseHas('users', $this->donnees_user);
	}

	public function testUserTagApresLInscription(): void
	{
		$this->donnees_user['password_confirmation'] = 'password';

		$this->donnees_user['regimes_alimentaires'] = [
			'Catégorie' => 2,
		];

		$this->post('/inscription', $this->donnees_user);

		$this->creationTag();

		$this->assertDatabaseHas('tags_user', $this->donnees('tag_user'));
	}

	public function testTag(): void
	{
		$this->post('/ajout-tag', $this->donnees_tag);

		$this->assertDatabaseHas('tags', $this->donnees_tag);
	}

	public function testRelationTagParent(): void
	{
		$this->creationTag();

		$this->donnees_tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [
				1,
			],
			'id_tags_enfant' => [],
		];

		$this->post('/ajout-tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag'));
	}

	public function testRelationTagEnfant(): void
	{
		$this->creationTag();

		$this->donnees_tag = [
			'nom' => 'Plat',
			'id_tags_parent' => [],
			'id_tags_enfant' => [
				1,
			],
		];

		$this->post('/ajout-tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag_inverse'));
	}

	public function testRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_recette);

		unset($this->donnees_recette['ingredients'], $this->donnees_recette['quantites']);

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testUstensileDansAjoutRecette(): void
	{
		$this->donnees_recette['ustensiles'] = [
			'Cuillière' => 2,
		];

		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('ustensiles', $this->donnees_ustensile);
	}

	public function testModeDeCuissonDansAjoutRecette(): void
	{
		$this->donnees_recette['mode_de_cuissons'] = [
			'Four' => 2,
		];

		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('mode_de_cuissons', $this->donnees_mode_de_cuisson);
	}

	public function testIngredientDansAjoutRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_recette);

		$this->assertDatabaseHas('ingredients', $this->donnees_ingredient);
	}
}

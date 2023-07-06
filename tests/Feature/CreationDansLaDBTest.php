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

	private array $donnees_tag_recette;

	private array $donnees_tag_recette_ingredient;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_user = $this->donneesUser();
		$this->donnees_tag = $this->donneesTag();
		$this->donnees_recette = $this->donneesRecette();
		$this->donnees_tag_recette = $this->donneesTagRecette();
		$this->donnees_tag_recette_ingredient = $this->donneesTagRecetteIngredient();
	}

	public function testUserApresLInscription(): void
	{
		$this->donnees_user['password_confirmation'] = 'password';

		$this->donnees_user['regimes_alimentaires'] = null;

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

		$this->assertDatabaseHas('tags_user', $this->donneesTagUser());
	}

	public function testTag(): void
	{
		$this->post('/ajout_tag', $this->donnees_tag);

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

		$this->post('/ajout_tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', $this->donneesRelationTag());
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

		$this->post('/ajout_tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', $this->donneesRelationTagInverse());
	}

	public function testRecette(): void
	{
		$this->post('/ajout_recette', $this->donnees_recette);

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testTagRecetteUstensile(): void
	{
		$this->donnees_recette['ustensiles'] = [
			'Cuillière' => 2,
		];

		$this->post('/ajout_recette', $this->donnees_recette);

		$this->assertDatabaseHas('tags_recette', $this->donnees_tag_recette);
	}

	public function testTagRecetteModeDeCuisson(): void
	{
		$this->donnees_recette['mode_de_cuissons'] = [
			'Four' => 2,
		];

		$this->post('/ajout_recette', $this->donnees_recette);

		$this->assertDatabaseHas('tags_recette', $this->donnees_tag_recette);
	}

	public function testTagRecetteIngredient(): void
	{
		$this->donnees_recette['ingredients'] = [
			'Carotte' => 2,
		];

		$this->donnees_recette['quantites'] = [
			'Carotte' => 1,
		];

		$this->post('/ajout_recette', $this->donnees_recette);

		$this->assertDatabaseHas('tags_recette', $this->donnees_tag_recette_ingredient);
	}
}

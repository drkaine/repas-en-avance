<?php

declare(strict_types = 1);

namespace Tests\Feature\DansLaBaseDeDonnee\Creation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class ApresLAjoutRecetteTest extends TestCase
{
	use RefreshDatabase;
	use RecuperationDonneesDeTestTrait;
	use ModelDeTestTrait;

	private array $donnees_recette;

	private array $donnees_formulaire_ajout_recette;

	private array $donnees_ustensile;

	private array $donnees_mode_de_cuisson;

	private array $donnees_ingredient;

	private array $donnees_photo;

	private array $donnees_auteur;

	private array $auteur_non_user;

	protected function setUp(): void
	{
		parent::setUp();

		$this->donnees_recette = $this->donnees('recette');
		$this->donnees_ustensile = $this->donnees('ustensile');
		$this->donnees_mode_de_cuisson = $this->donnees('mode_de_cuisson');
		$this->donnees_ingredient = $this->donnees('ingredient');
		$this->donnees_photo = $this->donnees('photo');
		$this->donnees_auteur = $this->donnees('auteur');
		$this->auteur_non_user = $this->donnees('auteur_non_user');

		$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();

		$this->userConnecte();
	}

	public function testRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('recettes', $this->donnees_recette);
	}

	public function testUstensileDansAjoutRecette(): void
	{
		$this->donnees_formulaire_ajout_recette['ustensiles'] = [
			'Cuillière' => 2,
		];

		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('ustensiles', $this->donnees_ustensile);
	}

	public function testModeDeCuissonDansAjoutRecette(): void
	{
		$this->donnees_formulaire_ajout_recette['mode_de_cuissons'] = [
			'Four' => 2,
		];

		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('mode_de_cuissons', $this->donnees_mode_de_cuisson);
	}

	public function testIngredientDansAjoutRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('ingredients', $this->donnees_ingredient);
	}

	public function testPhotoDansAjoutRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('photos', $this->donnees_photo);
	}

	public function testLeUserEstLAuteurEtNExistePas(): void
	{
		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('auteurs', $this->donnees_auteur);
	}

	public function testLeUserEstLAuteurEtExisteDeja(): void
	{
		$this->creation('Auteur', 'auteur');

		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('auteurs', $this->donnees_auteur);

		$this->assertDatabaseCount('auteurs', 1);
	}

	public function testLeUserNEstPasLAuteurEtNExistePas(): void
	{
		$this->donnees_formulaire_ajout_recette['auteur'] = $this->auteur_non_user;

		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('auteurs', $this->auteur_non_user);
	}

	public function testLeUserNEstPasLAuteurEtExiste(): void
	{
		$this->creation('Auteur', 'auteur_non_user');

		$this->donnees_formulaire_ajout_recette['auteur'] = $this->auteur_non_user;

		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('auteurs', $this->auteur_non_user);

		$this->assertDatabaseCount('auteurs', 1);
	}

	public function testLienAuteurEtRecette(): void
	{
		$auteur_recette = $this->donnees('auteur_recette');

		$this->creation('AuteurRecette', 'auteur_recette');

		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$this->assertDatabaseHas('auteur_recettes', $auteur_recette);
	}
}

<?php

declare(strict_types = 1);

namespace Tests\Feature\Envoie;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;

/**
 * @coversNothing
 */
class FormulaireTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_user;

	private array $donnees_formulaire_ajout_recette;

	private array $donnees_mot_de_passe_oublie;

	private array $donnees_user_anonyme;

	private array $donnees_user_anonyme_recupere;

	protected function setUp(): void
	{
		parent::setUp();

		$this->creationTagsAjoutRecette();

		$this->donnees_user = $this->donnees('user');

		$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();

		$this->donnees_mot_de_passe_oublie = $this->donnees('mot_de_passe_oublie');

		$this->donnees_user_anonyme = $this->donnees('user');

		$this->donnees_user_anonyme_recupere = $this->donnees('user_anonyme_recupere');

		$this->creation('User', 'user_anonyme');
	}

	public function testInscription(): void
	{
		$this->creationRegimesAlimentaire();

		$this->donnees_user['password_confirmation'] = 'password';

		$this->donnees_user['regimes_alimentaires'] = [];

		$response = $this->post('/inscription', $this->donnees_user);

		$response->assertStatus(200);
	}

	public function testConnexion(): void
	{
		$this->creationUser();

		unset($this->donnees_user['nom']);

		$response = $this->post('/connexion', $this->donnees_user);

		$response->assertRedirect('/');
	}

	public function testAjoutTag(): void
	{
		$response = $this->post('/ajout-tag', [
			'nom' => 'Catégorie',
			'tags_parent' => [],
			'tags_enfant' => [],
		]);

		$response->assertStatus(200);
	}

	public function testAjoutRecette(): void
	{
		$response = $this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		$response->assertStatus(200);
	}

	public function testDemandeMotDePasseOublie(): void
	{
		$this->creationUser();

		$response = $this->post('/demande-mot-de-passe-oublie', [
			'email' => 'email@test.fr',
		]);

		$response->assertStatus(200);
	}

	public function testMotDePasseOublie(): void
	{
		$this->creationUser();

		$response = $this->post('/mot-de-passe-oublie', $this->donnees_mot_de_passe_oublie);

		$response->assertStatus(200);
	}

	public function testRecuperationCompte(): void
	{
		$response = $this->post('/recuperation-compte', $this->donnees_user_anonyme_recupere);

		$response->assertRedirect('/');
	}
}

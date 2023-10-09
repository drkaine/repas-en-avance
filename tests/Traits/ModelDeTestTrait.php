<?php

declare(strict_types = 1);

namespace Tests\Traits;

use App\Models\User;

trait ModelDeTestTrait
{
	use RecuperationDonneesDeTestTrait;

	public function creation(string $nom_model, string $nom_donnees_voulue): void
	{
		$chemin_model = 'App\\Models\\' . $nom_model;

		$model = new $chemin_model;

		$model->factory()->create($this->donnees($nom_donnees_voulue));
	}

	public function creationFichierPhoto(): void
	{
		$this->donnees('fichier_photo');
	}

	public function userConnecte(): void
	{
		$user = $this->creationUser();

		$this->actingAs($user);
	}

	public function creationUser(): User
	{
		$user = new User;

		$user = $user->factory()->create($this->donnees('user'));

		return $user;
	}

	public function creationUserNonConfirme(): User
	{
		$user = new User;

		$donnees_user = $this->donnees('user');
		unset($donnees_user['email_verified_at']);

		$user = $user->factory()->create();

		return $user;
	}

	public function creationDonnees(string $nom_model, string $nom_donnees_voulue): void
	{
		$chemin_model = 'App\\Models\\' . $nom_model;

		$model = new $chemin_model;

		foreach ($this->donnees($nom_donnees_voulue) as $donnee_voulue) {
			$model->factory()->create($donnee_voulue);
		}
	}

	public function creationregimesAlimentaire(): void
	{
		$this->creationDonnees('Tag', 'tags_regimes_alimentaire');

		$this->creationDonnees('RelationTag', 'relation_tags');
	}

	public function creationTagsAjoutRecette(): void
	{
		$this->creationDonnees('Tag', 'tag_mode_de_cuisson');

		$this->creationDonnees('Tag', 'tag_ustensile');

		$this->creationDonnees('RelationTag', 'relation_tags');

		$this->creationDonnees('Tag', 'tag_ingredient');
	}
}

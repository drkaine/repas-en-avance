<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class TelechargementFichierTest extends TestCase
{
	use RecuperationDonneesDeTestTrait;
	use RefreshDatabase;
	use ModelDeTestTrait;

	private array $donnees_formulaire_ajout_recette;

	private File $donnees_fichier_photo;

	protected function setUp(): void
	{
		parent::setUp();

		$this->creationTagsAjoutRecette();
		$this->donnees_fichier_photo = $this->donnees('fichier_photo');
		$this->donnees_formulaire_ajout_recette = $this->donneesFormulaireAjoutRecette();
	}

	public function testPhotoRecette(): void
	{
		$this->post('/ajout-recette', $this->donnees_formulaire_ajout_recette);

		self::assertFileExists(storage_path('app/public/' . $this->donnees_fichier_photo->name));

		Storage::delete(storage_path('app/public/' . $this->donnees_fichier_photo->name));
	}
}

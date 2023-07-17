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
class ApresLajoutTagTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	private array $donnees_tag;

	protected function setUp(): void
	{
		parent::setUp();
		$this->donnees_tag = $this->donnees('tag');
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
			'tags_parent' => [
				'1',
			],
			'tags_enfant' => null,
		];

		$this->post('/ajout-tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag'));
	}

	public function testRelationTagEnfant(): void
	{
		$this->creationTag();

		$this->donnees_tag = [
			'nom' => 'Plat',
			'tags_parent' => null,
			'tags_enfant' => [
				'1',
			],
		];

		$this->post('/ajout-tag', $this->donnees_tag);

		$this->assertDatabaseHas('relation_tags', $this->donnees('relation_tag_inverse'));
	}
}

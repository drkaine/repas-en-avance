<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class UserNonAuthentifieTest extends TestCase
{
	public function testMonCompte(): void
	{
		$response = $this->get('mon-compte');

		$response->assertRedirect('inscription');
	}

	public function testAjoutTag(): void
	{
		$response = $this->get('ajout-tag');

		$response->assertRedirect('inscription');
	}

	public function testAjoutRecette(): void
	{
		$response = $this->get('ajout-recette');

		$response->assertRedirect('inscription');
	}

	public function testCarnetRecettes(): void
	{
		$response = $this->get('carnet-recettes');

		$response->assertRedirect('connexion');
	}
}

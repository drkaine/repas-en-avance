<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class RedirectionSiUserNonAuthentifieTest extends TestCase
{
	public function testMonCompte(): void
	{
		$response = $this->get('mon_compte');

		$response->assertRedirect('inscription');
	}
}

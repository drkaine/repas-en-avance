<?php

declare(strict_types = 1);

namespace Tests\Feature\Envoie;

use App\Notifications\ConfirmationEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Tests\Traits\ModelDeTestTrait;
use Tests\Traits\RecuperationDonneesDeTestTrait;

/**
 * @coversNothing
 */
class NotificationTest extends TestCase
{
	use RefreshDatabase;
	use ModelDeTestTrait;
	use RecuperationDonneesDeTestTrait;

	public function testVerificationEmailIsSent(): void
	{
		Notification::fake();

		$user = $this->creationUser();

		$user->notify(new ConfirmationEmail);

		Notification::assertSentTo($user, ConfirmationEmail::class);
	}
}

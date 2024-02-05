<?php

declare(strict_types = 1);
use App\Notifications\ConfirmationEmail;
use Illuminate\Support\Facades\Notification;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

uses(Tests\Traits\RecuperationDonneesDeTestTrait::class);

test('verification email is sent', function (): void {
	Notification::fake();

	$user = $this->creationUser();

	$user->notify(new ConfirmationEmail);

	Notification::assertSentTo($user, ConfirmationEmail::class);
});

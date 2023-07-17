<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmationEmail extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 */
	public function __construct()
	{
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable): array
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{
		$lien_de_confirmation = url('/confirmation-email/' . $notifiable->email);

		return (new MailMessage)->
			from('sender@example.com', 'Sender Name')->
			subject('Confirmation de l\'adresse e-mail')->
			line('Veuillez cliquer sur le bouton ci-dessous pour confirmer votre adresse e-mail.')->
			action('Confirmer l\'adresse e-mail', $lien_de_confirmation)->
			line('Si vous n\'avez pas créé de compte, aucune action n\'est requise.');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(object $notifiable): array
	{
		return [
		];
	}
}

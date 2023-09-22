<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class MotDePasseOublieEmail extends Notification
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
		$identifiant = Str::random(12);
		$lien_vers_le_formulaire = url('/mot-de-passe-oublie/' . $notifiable->email);

		return (new MailMessage)->
			from('ne_pas_repondre@darkaine.fr', 'Repas en avance')->
			subject('Mot de passe oublié')->
			line('Bonjour,
				Pour changer votre mot de passe,
				Veuillez cliquer sur le bouton ci-dessous pour confirmer votre adresse e-mail.')->
			action('Changement de mot de passe', $lien_vers_le_formulaire)->
			line('Si vous n\'avez pas fait cette demande, veuillez ne pas prendre en compte ce mail.\\n Belle journée à bientôt !');
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

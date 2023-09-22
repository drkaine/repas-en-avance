<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecuperationCompteEmail extends Notification
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
		$lien_de_recuperation = url('/recuperation-compte');

		return (new MailMessage)->
			from('ne_pas_repondre@darkaine.fr', 'Repas en avance')->
			subject('suppression de votre compte')->
			line('Bonjour,
				Vous venez de demander la suppression de votre compte ou avez été inactif depuis 3 mois.
				Votre compte restera en anonyme pendant 6 mois, puis sera supprimé.
				Cliquer ci-dessous si vous changez d\'avis et vouler récupérer votre compte et indiquez ' . $notifiable->id . ' dans le champs code.')->
			action('Confirmer l\'adresse e-mail', $lien_de_recuperation)->
			line('Si vous n\'avez pas créé de compte, aucune action n\'est requise.\\n Belle journée à bientôt !');
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

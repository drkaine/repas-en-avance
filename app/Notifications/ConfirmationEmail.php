<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmationEmail extends Notification
{
	use Queueable;

	private array $texte_mail;

	/**
	 * Create a new notification instance.
	 */
	public function __construct()
	{
		$this->texte_mail = config('texte_mail.confirmation_email');
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
			from('ne_pas_repondre@darkaine.fr', 'Repas en avance')->
			subject($this->texte_mail['sujet'])->
			line($this->texte_mail['line1'])->
			action('Confirmer l\'adresse e-mail', $lien_de_confirmation)->
			line($this->texte_mail['line2']);
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

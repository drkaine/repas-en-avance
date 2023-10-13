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

	private array $texte_mail;

	/**
	 * Create a new notification instance.
	 */
	public function __construct()
	{
		$this->texte_mail = config('texte_mail.mot_de_passe_oublie');
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
		$lien_vers_le_formulaire = url('/mot-de-passe-oublie/' . $identifiant);

		return (new MailMessage)->
			from('ne_pas_repondre@darkaine.fr', 'Repas en avance')->
			subject($this->texte_mail['sujet'])->
			line($this->texte_mail['line1'])->
			action('Changement de mot de passe', $lien_vers_le_formulaire)->
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

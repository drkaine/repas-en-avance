<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use App\Traits\GestionDB\ModificationTrait;
use App\Traits\GestionDB\SelectTrait;
use App\Traits\GestionDB\SuppressionTrait;
use Carbon\Carbon;

class GestionUsersInactifService
{
	use SuppressionTrait;
	use ModificationTrait;
	use SelectTrait;

	private Carbon $date;

	public function __construct()
	{
		$this->date = new Carbon;
	}

	public function anonymiser(): void
	{
		$this->userEnAnonyme($this->date->now()->subMonths(3));
	}

	public function supprimer(): void
	{
		$users = new User;

		$id_users_anonymes = $this->toutesLesUsersParDerniereConnexion($this->date->now()->subMonths(6));

		$this->userParListIdUser($id_users_anonymes);

		$this->regimeAlimentaireParListIdUser($id_users_anonymes);
	}
}

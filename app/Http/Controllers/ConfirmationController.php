<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ModificationUserService;
use App\Traits\GestionDB\SelectTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class ConfirmationController extends Controller
{
	use SelectTrait;

	public function confirmationEmail(string $email_user): View
	{
		$date = new Carbon;

		$user = new User;

		$user = $this->userParEmail($email_user);

		$modification_user = new ModificationUserService($user);

		$modification_user->modificationChamp('email_verified_at', $date->now());

		$modification_user->sauvegarde();

		return view('confirmation_email');
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use app\Models\User;
use App\Services\ModificationUserService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class ConfirmationController extends Controller
{
	public function confirmationEmail(string $email_user): View
	{
		$date = new Carbon;

		$user = new User;

		$user = $user->where('email', $email_user)->
			firstOrFail();

		$modification_user = new ModificationUserService($user);

		$modification_user->emailVerifiedAt($date->now());

		$modification_user->sauvegarde();

		return view('confirmation_email');
	}
}

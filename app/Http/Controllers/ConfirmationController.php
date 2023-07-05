<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use app\Models\User;
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

		$user->email_verified_at = $date->now();

		$user->save();

		return view('confirmation_email');
	}
}

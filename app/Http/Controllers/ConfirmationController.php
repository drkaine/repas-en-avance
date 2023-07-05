<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use app\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class ConfirmationController extends Controller
{
	public function confirmationEmail(int $id_user): View
	{
		$date = new Carbon;

		$user = new User;

		$user = $user->findOrFail($id_user);

		$user->email_verified_at = $date->now();

		$user->save();

		return view('confirmation_email');
	}
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class DeconnexionUserController extends Controller
{
	public function deconnexion(): RedirectResponse | Redirector
	{
		Auth::logout();

		return redirect('/');
	}
}

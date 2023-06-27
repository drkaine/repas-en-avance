<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class DeconnexionController extends Controller
{
	public function user(): RedirectResponse | Redirector
	{
		Auth::logout();

		return redirect('/');
	}
}

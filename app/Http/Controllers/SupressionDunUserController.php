<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SupressionDunUserController extends Controller
{
	public function anonymisation_du_compte(): RedirectResponse | Redirector
	{
		return redirect('/');
	}
}

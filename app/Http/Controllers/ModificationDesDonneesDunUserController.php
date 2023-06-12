<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ModificationDesDonneesDunUserController extends Controller
{
	public function ModificationUser(Request $request): RedirectResponse | Redirector
	{
		return redirect('/');
	}
}

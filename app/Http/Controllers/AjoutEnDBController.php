<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjoutEnDBController extends Controller
{
	public function __construct(private Request $request)
	{

	}

	public function user(): void
	{
		User::create([
			'nom' => $this->request->nom,
			'email' => $this->request->email,
			'password' => bcrypt($this->request->password),
		]);
	}
}

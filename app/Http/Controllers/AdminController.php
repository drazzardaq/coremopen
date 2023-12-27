<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
		public function index()
		{
				return Inertia::render('Admin', ['items' => User::with('items')->get()]);
		}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityController extends Controller
{
    public function getPriorities()
		{
				return Priority::where('user_id', auth()->id())->get();
		}
}

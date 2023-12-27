<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
		public function getStatuses()
		{
				return Status::where('user_id', auth()->id())->get();
		}
}

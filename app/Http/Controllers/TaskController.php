<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Status;
use App\Models\Priority;

class TaskController extends Controller
{
		public function index(\Request $request)
		{
				$statuses = Status::get();
				$priorities = Priority::get();

				return Inertia::render('App/Tasks', [
						'items' => Item::query()
								->where('category_id', 4)
								->when($request::input('search'), function ($query, $search) {
										$query->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%")->orWhere('tag', 'like', "%{$search}%");
								})
								->when($request::input('sortBy'), function ($query, $field) {
										$query->orderBy($field, \Request::input('direction'));
								})
								->when(!$request::input('sortBy'), function ($query, $field) {
										$query->orderBy('status_id', 'asc');
								})
								->when(!$request::input('includeArchive') || $request::input('includeArchive') === 'false', function ($query) {
										$query->where('archived', 0);
								})
								->with(['category', 'priority', 'status'])
								->paginate(5)
								->onEachSide(0)
								->withQueryString(),
						'filters' => $request::only(['search', 'includeArchive', 'sortBy', 'direction']),
						'statuses' => $statuses,
						'priorities' => $priorities,
				]);
		}
}

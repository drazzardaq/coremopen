<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PriorityController;
use Inertia\Inertia;
use App\Models\Item;

class ItemController extends Controller
{
		public function index(\Request $request)
		{
				$statuses = (new StatusController)->getStatuses();
				$priorities = (new PriorityController)->getPriorities();

				return Inertia::render('Dashboard', [
						'items' => Item::query()
								->when($request::input('search'), function ($query, $search) {
										$query->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%")->orWhere('tag', 'like', "%{$search}%");
								})
								->when($request::input('sortBy'), function ($query, $sortBy) {
										$query->orderBy($sortBy, \Request::input('direction'));
								})
								->when(!$request::input('sortBy'), function ($query) {
										$query->orderBy('status_id', 'asc');
								})
								->when(!$request::input('includeArchive') || $request::input('includeArchive') === 'false', function ($query) {
										$query->where('archived', 0);
								})
								->with(['category', 'priority', 'status'])
								->orderBy('id', 'asc')
								->paginate(8)
								->onEachSide(0)
								->withQueryString(),
								// ->through(fn($item) => [
								// 		'id' => $item->id,
								// 		'category_id' => $item->category_id,
								// 		'status_id' => $item->status_id,
								// 		'priority_id' => $item->priority_id,
								// 		'title' => $item->title,
								// 		'description' => $item->description,
								// 		// 'closure' => $item->closure,
								// 		// 'recurring' => $item->recurring,
								// 		'date' => $item->date,
								// 		'tag' => $item->tag,
								// 		// 'related_ids' => $item->related_ids,
								// 		'archived' => $item->archived,
								// 		'status' => $item->status,
								// 		'priority' => $item->priority,
								// 		'category' => $item->category,
								// ]),

						'filters' => $request::only(['search', 'includeArchive', 'sortBy', 'direction']),
						'statuses' => $statuses,
						'priorities' => $priorities,
				]);
		}

		public function store(ItemRequest $request)
		{		
				try {
						Item::create($request->all());

						return 'Item added.';
						// return 'Item successfully added.';
				} catch (Exception $e) {
						\Log::info('Exception during new item creation:', $e->getMessage());
				}
		}

		public function destroy(Request $request)
		{		
				try {
						Item::destroy($request->id);

						return 'Item deleted.';
				} catch (Exception $e) {
						\Log::info('Exception during item deletion:', $e->getMessage());
				}
		}

		public function archive(Request $request)
		{
				try {
						$item = Item::find($request->id);

						if ($item->archived === 1) $item->archived = 0;
						else $item->archived = 1;

						$item->save();

						if ($item->archived === 1) return 'Item archived.';
						else return 'Item unarchived.';
				} catch (Exception $e) {
						\Log::info('Exception during item archived status change:', $e->getMessage());
				}
		}

		public function update(ItemRequest $request)
		{
				try {
						$item = Item::find($request->id);
						$item->update($request->all());

						return 'Item updated.';
				} catch (Exception $e) {
						\Log::info('Exception during item archived status change:', $e->getMessage());
				}
		}

		public function status(Request $request)
		{
				try {
						$item = Item::find($request->id);
						$item->status_id = $request->status_id;
						$item->save();

						return 'Status updated.';
				} catch (Exception $e) {
						\Log::info('Exception during item status change:', $e->getMessage());
				}
		}

		public function export(Request $request)
		{
   			$fileName = 'items.csv';
   			$items = Item::where('archived', 0)->with(['category', 'priority', 'status'])->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $columns = array('Title', 'Description', 'Date', 'Status', 'Priority', 'Tag');

        $callback = function() use($items, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($items as $item) {
                $row['Title'] = $item->title;
                $row['Description'] = $item->description;
                $row['Date'] = $item->date;
                $row['Status'] = $item->status['name'];
                $row['Priority'] = $item->priority['name'];
                $row['Tag'] = $item->tag;

                fputcsv($file, array($row['Title'], $row['Description'], $row['Date'], $row['Status'], $row['Priority'], $row['Tag']));
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 200, $headers);
    }
}

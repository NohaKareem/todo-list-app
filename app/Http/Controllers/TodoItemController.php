<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
use App\TodoItem;
use App\Transformers\TodoItemTransformer;

class TodoItemController extends Controller
{
     /**  
     * Restrict access to entire controller to logged in users only
     * */ 
    public function __construct() {
        $this->middleware('auth');
    }

    /** 
     * Store a newly created todo item record in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'item' => 'required|max:255', 
            'done' => 'required'
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:3000' // image max limit 3MB
        ]);
        
            // // check if image is provided, since it's optional
            // $image = $request->image;
            // $imageName = $image != null ? Storage::putFile('public', $image) : ""; 

        TodoItem::Create([
            'item' => $request->input('item'),
            'done' => false
            // 'image' => $imageName,
            // 'user_id' => auth()->id()
        ]);

        // return all todo items as json 
        $todoItemTransformer = new TodoItemTransformer();
        $todoItems = TodoItem::all()->map(function ($todoItem) use ($todoItemTransformer) {
            return $todoItemTransformer->transform($todoItem);
        });

        return response()->json($todoItems);
    }

    /**
	 * Update TodoItem
	 *
	 * @param Request request
	 * @param TodoItemTransformer $TodoItemTransformer
	 * @param $id
	 * @return \illuminate\Http\JsonResponse
	 */
	public function update(
		Request $request, 
		TodoItemTransformer $todoItemTransformer, 
		$id) {

        $todoItem = TodoItem::find($id);

		if ($request->has('done')) {
			$todoItem->update($request->all());
		}

            // add image
            // if($request->has('image')) {
            // 	$imageName = Storage::putFile('public/image', $request->image);
            // 	$todoItem->imageName = $imageName;
            // 	$todoItem->save();
            // }

		$todoItem->fresh();

        // return response()->json($todoItemTransformer->transform($todoItem));
        $todoItemTransformer = new TodoItemTransformer();
        $todoItems = TodoItem::all()->map(function ($todoItem) use ($todoItemTransformer) {
            return $todoItemTransformer->transform($todoItem);
        });

        return response()->json($todoItems);
    }
    
     /**
	 * Toggle TodoItem's done status
	 *
	 * @param Request request
	 * @param TodoItemTransformer $TodoItemTransformer
	 * @param $id
	 * @return \illuminate\Http\JsonResponse
	 */
	public function toggleTodo(
		Request $request, 
		TodoItemTransformer $todoItemTransformer, 
		$id) {

        $todoItem = TodoItem::find($id);

        $todoItem->done = ! $todoItem->done;
        $todoItem->save();

		$todoItem->fresh();

        $todoItemTransformer = new TodoItemTransformer();
        $todoItems = TodoItem::all()->map(function ($todoItem) use ($todoItemTransformer) {
            return $todoItemTransformer->transform($todoItem);
        });

        return response()->json($todoItems);
	}

    /**
     * Remove the specified todo item from storage.
     *
     * @param  \App\TodoItem  $todoItem
     * @return  \Illuminate\Http\Response 
     */
    public function destroy(ToDoItem $todoItem) {
        $todoItem->delete();

        // return all todo items as json
        $todoItemTransformer = new TodoItemTransformer();
        $todoItems = TodoItem::all()->map(function ($todoItem) use ($todoItemTransformer) {
            return $todoItemTransformer->transform($todoItem);
        });
        
        return response()->json($todoItems);
    }

    /**
     * Search for a particular todo item
     * 
     * @param $searchStr
     */
    public function search($searchStr) {
        $searchResults = TodoItem::query()
            ->where('item', 'LIKE', "%{$searchStr}%") 
            ->get();

        $todoItemTransformer = new TodoItemTransformer();
        $todoItems = $searchResults->map(function ($todoItem) use ($todoItemTransformer) {
            return $todoItemTransformer->transform($todoItem);
        });
        return response()->json($todoItems);
        // return compact('searchResults');        
    }
}

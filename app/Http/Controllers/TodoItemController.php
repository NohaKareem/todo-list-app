<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
use App\Transformers\TodoItemTransformer;
use App\TodoItem;

class TodoItemController extends Controller
{
     /**  
     * Restrict access to entire controller to logged in users only
     * */ 
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    /** 
     * ~~Store a newly created todo item record in storage.
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
        
        dump($todoItems);

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
}

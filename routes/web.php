<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::post("/todoItem", "TodoItemController@store")->name("todoitem.create"); 
Route::delete("/todoItem/{todoItem}", "TodoItemController@destroy")->name("todoitem.delete");
// Route::patch("/todoItem/{todoItem}", "TodoItemController@update")->name("todoitem.update");
Route::patch("/todoItem/{todoItem}", "TodoItemController@toggleTodo")->name("todoitem.update");

Route::get("/todoItem/search/{searchStr}", "TodoItemController@search")->name("todoitem.search");
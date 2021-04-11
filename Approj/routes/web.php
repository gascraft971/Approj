<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

Route::get("/", "PostController@index");
Route::resource("posts", "PostController");
Route::get("/dashboard", function() {
	return view("dashboard.index");
});
/*Route::post("/dashboard#{category}", function($category) {
	return view("dashboard.categories.$category.index");
});*/
Route::post("/dashboard/{category}", function($category) {
	$posts = Post::latest()->get();
	return view("dashboard.categories.$category.index", compact("posts"));
});

Auth::routes();

Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name("home");

<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LinkDataController;

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

Route::get("/", [PostController::class, "index"]);
Route::resource("posts", "PostController");

// Override Route::resource with these new and cooler things (so I can use UUID)
Route::get("post/{uuid}/edit", [PostController::class, "edit"]);
Route::patch("post/{uuid}", [PostController::class, "update"]);
Route::get("post/{uuid}/preview", [PostController::class, "preview"]);
Route::post("/post/{uuid}/publish", [PostController::class, "publish"]);

Route::get("/dashboard", function() {
	return view("dashboard.index");
});
Route::post("/dashboard/{category}", function($category) {
	$posts = Post::latest()->get();
	return view("dashboard.categories.$category.index", compact("posts"));
});

Auth::routes();

Route::get("/home", [HomeController::class, "index"])->name("home");

Route::post("/uploads/file", [FileUploadController::class, "file"]);
Route::post("/uploads/url", [FileUploadController::class, "url"]);
Route::get("/linkdata", [LinkDataController::class, "index"]);
